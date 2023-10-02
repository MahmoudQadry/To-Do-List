<?php

namespace App\Livewire;

use App\Models\ToDoList;
use Livewire\Component;
use Livewire\WithPagination;

class ToDo extends Component
{
    use WithPagination;
    public $name;
    public $search;
    public $editToDoId;
    public $editToDoName;
    // change theme of pagination to bootstrap.
    public $paginationTheme="bootstrap";
    public function render()
    {
        return view('livewire.to-do',[
            "toDos"=>ToDoList::where("name","like","%$this->search%")->paginate(3),
        ]);
    }
    public function create(){
        //validation
        $validate=$this->validate([
            "name"=>"required||min:4"
        ]);
        //creation
        ToDoList::create($validate);
        //reset inputs
        $this->reset("name");
        //send message
        session()->flash("success","created");
    }
    public function delete($toDoId){
        // check if exist
        $toDo=ToDoList::find($toDoId);

        $toDo->delete();
    }
    public function toggle($toDoId){
        // check if exist
        $toDo=ToDoList::find($toDoId);

        //updated status of completed
        $toDo->completed = !$toDo->completed;
        $toDo->save();
    }
    public function edit($toDoId){
        $this->editToDoId=$toDoId;
        $this->editToDoName= ToDoList::find($toDoId)->name;
    }
    public function cancelEditing(){
        $this->reset("editToDoId","editToDoName");
    }
    public function update(){
        // validation
        $this->validate([
            "editToDoName" =>"required||min:4",
        ]);
        // update name
        ToDoList::find($this->editToDoName)->update([
            "name"=>"$this->editToDoName"
        ]);
        $this->cancelEditing();
    }
}
