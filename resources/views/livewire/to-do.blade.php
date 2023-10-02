<div>
    {{-- creation form --}}
    @include("livewire.inc.create-toDo")

    {{-- search component --}}
    @include("livewire.inc.SearchList")

    {{-- show to do list --}}
    @foreach ($toDos as $toDo)
    @include("livewire.inc.toDos")
    @endforeach

    <!-- Pagination goes here -->
    <div class="my-2">
        {{$toDos->links()}}
    </div>
</div>
