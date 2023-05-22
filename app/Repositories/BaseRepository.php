<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    protected $relations;
    protected $searchable_columns;
    
    public function __construct(Model $model, array $relations=[], array $searchable_columns=[]){

        $this->model = $model;
        $this->relations = $relations;
        $this->searchable_columns =$searchable_columns;
    }


    public function all(){
        $query = $this->model;
        if(!empty($this->relations))
            $query = $query->with($this->relations);
        
        return $query->get();
    }

    public function get(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function save(Model $model)
    {
        $model->save();
        return $model;
    }

    public function delete(Model $model)
    {
        $model->delete();
        return $model;
    }

    public function paginate($start,$length,$order_dir,$order_name,$search)
    {
        $query = $this->model::select('*');
        $is_first=true;

        foreach ($this->searchable_columns as $column) {
            if($is_first){
                $query = $query->where("$column", 'LIKE', "%$search%");
                $is_first = false;
            }else{
                $query = $query->orWhere("$column", 'LIKE', "%$search%");
            }
        }

        //Esto es asi porque si envia un -1 es porque quiere ver todo
        if(intval($length)>0){
            $query = $query->skip($start)->take($length);
        }

        $data = $query->orderBy($order_name, $order_dir)->get();

        //Estoy contando los que resultaron del filtro ....
        //luego en el front se puede indicar...mostrando 10 de 150 elementos ...
        $records_filtered = $data->count();

        //Total sin filtro para luego en el front poder indicar...mostrando 10 de 150 elementos ...
        //Se puede quitar si no es necesario.
        $records_total = $this->model::count();

        return ['data' => $data,'recordsTotal'=>$records_total,'recordsFiltered'=>$records_filtered];

    }
}