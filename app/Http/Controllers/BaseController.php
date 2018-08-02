<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Http\Request;

// 
// Base controller for admin panels
// To be inherited by other controllers
// 
class BaseController extends Controller
{
    // base folder for views
    protected $base = '';
    // Resource model class name
    protected $cls = '';
    // Field names where images are supposed to be uploaded
    protected $images = [];
    // default sorting
    protected $orderBy = 'created_at';
    protected $orderByDir = 'DESC';
    // Set these attributes as empty strings if they weren't set in request
    protected $setEmpty = [];
    // Handle these attributes as checkboxes (false if not set)
    protected $checkboxes = [];
    // Set many to many relation from these attributes, like
    // 'cities' => 'cities_ids'
    // this will call 'cities' relation 'sync' method
    // using 'cities_ids' request value argument
    protected $manyToMany = [];

    /**
     * Returns relation for current search conditions
     * @param  $data Request 'filter' parameter
     * @return Relation
     */
    protected function getIndexItems($data)
    {
        return call_user_func([$this->cls, 'orderBy'], $this->orderBy, $this->orderByDir)->paginate(20);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        $filter = $request->input('filter');
        $items = $this->getIndexItems($filter);
        $additional = $this->getAdditionalData($request->all());
        return view($this->base . '.index', array_merge(compact('items', 'filter'), $additional));
    }

    /**
     * Return additional parameters, which should be passed to resource form
     * @param  $data Request data
     * @return array
     */
    protected function getAdditionalData($data = null) {
        return [];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        $item = new $this->cls;
        return view($this->base . '.form', array_merge(compact('item'), $this->getAdditionalData($request->all())));
    }

    /**
     * Modify request data which is used on create/update actions
     * could be used to do some preparations before saving data
     * @param  $data Request data
     * @return array
     */
    protected function modifyRequestData($data)
    {
        return $data;
    }

    /**
     * Create a new model or update the existing,
     * move uploaded images to right location and set relations
     * @param  Eloquent $item model
     * @param  Request $request request object
     * @return void
     */
    protected function save($item, Request $request)
    {
        $validator = $this->getValidator($request);
        if ($validator->passes()) {
            $data = $this->modifyRequestData($request->all());
            foreach ($this->setEmpty as $key) {
                if (!isset($data[$key])) {
                    $data[$key] = '';
                }
            }
            foreach ($this->checkboxes as $key) {
                if (!isset($data[$key])) {
                    $data[$key] = false;
                }
                if ($data[$key] == '1') {
                    $data[$key] = true;
                }
                else {
                    $data[$key] = false;
                }
            }
            $item->fill($data);
            foreach ($this->images as $image) {
                $file_name = Input::file($image);
                if ($file_name != null) {
                    $new_file = str_random(10) . '.' . $file_name->getClientOriginalExtension();
                    $file_name->move(public_path('category_images'), $new_file);
                    $item->$image = '/category_images/' . $new_file;
                }
            }
            $item->save();
            foreach ($this->manyToMany as $key => $value) {
                if (isset($data[$value])) {
                    $item->$key()->sync($data[$value]);
                }
            }
            return redirect($this->redirectOnCreatePath($request));
        } else {
            $item->fill($request->all());
            $errors = $validator->messages();
            return view($this->base . '.form', array_merge(compact('item', 'errors'), $this->getAdditionalData($request->all())));
        }
    }

    protected function redirectOnCreatePath(Request $request)
    {
        return route($this->base . '.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        return $this->save(new $this->cls, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('create', $this->cls)) {
            return redirect('/');
        }
        $item = call_user_func([$this->cls, 'find'], $id);
        return view($this->base . '.show', array_merge(compact('item'), $this->getAdditionalData()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $item = call_user_func([$this->cls, 'find'], $id);
        if (!Gate::allows('update', $item)) {
            return redirect('/');
        }
        return view($this->base . '.form', array_merge(compact('item'), $this->getAdditionalData($request->all())));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = call_user_func([$this->cls, 'find'], $id);
        if (!Gate::allows('update', $item)) {
            return redirect('/');
        }
        return $this->save($item, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = call_user_func([$this->cls, 'find'], $id);
        if (!Gate::allows('delete', $item)) {
            return redirect('/');
        }
        $item->delete();
        return redirect(route($this->base . '.index'));
    }

    /**
     * Create validator to validate the request data,
     * could be customized based on request params or other stuff
     * @param  Request $request Request object
     * @return Validator
     */
    public function getValidator(Request $request)
    {
        return Validator::make($request->all(), [
        ]);
    }
}
