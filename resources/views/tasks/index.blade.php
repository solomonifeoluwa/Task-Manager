<select onchange="window.location='?project_id='+this.value">
    @foreach($projects as $project)
        <option value="{{ $project->id }}">{{ $project->name }}</option>
    @endforeach
</select>

<form action="/tasks" method="POST">
    @csrf
    <input name="name" placeholder="Task name" required>
    <select name="project_id">
        @foreach($projects as $project)
            <option value="{{ $project->id }}">{{ $project->name }}</option>
        @endforeach
    </select>
    <button>Add Task</button>
</form>

@php
    $selectedProjectId = request()->project_id
        ?? ($projects->first()->id ?? null);
@endphp

@livewire('task-list', ['projectId' => $selectedProjectId])




<script>
const list = document.getElementById('taskList');

let dragged;

list.addEventListener('dragstart', e => dragged = e.target);

list.addEventListener('dragover', e => e.preventDefault());

list.addEventListener('drop', e => {
    if (e.target.tagName === 'LI') {
        list.insertBefore(dragged, e.target);
        saveOrder();
    }
});

function saveOrder() {
    let order = [...document.querySelectorAll('#taskList li')]
                    .map(li => li.dataset.id);

    fetch('/tasks/reorder', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({ order })
    });
}
</script>
