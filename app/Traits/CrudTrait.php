<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait CrudTrait
{
    public function store(Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model;
        $item->fill($data);
        $item->save();
        return $item;
    }
    /**
     * update existing item.
     *
     * @param  Integer $id integer item primary key.
     * @param Request $request Illuminate\Http\Request
     * @return send updated item object.
     */
    public function update($id, Request $request)
    {
        $data = $this->setDataPayload($request);
        $item = $this->model->findOrFail($id);
        $item->fill($data);
        $item->save();
        return $item;
    }
    /**
     * get requested item and send back.
     *
     * @param  Integer $id: integer primary key value.
     * @return send requested item data.
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }
    /**
     * Delete item by primary key id.
     *
     * @param  Integer $id integer of primary key id.
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    /**
     * set data for saving
     *
     * @param  Request $request Illuminate\Http\Request
     * @return array of data.
     */
    protected function setDataPayload(Request $request)
    {
        return $request->all();
    }
}
