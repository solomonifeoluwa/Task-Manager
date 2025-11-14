<div x-data="{
    init() {
        this.sortable = new Sortable(this.$refs.list, {
            animation: 150,
            onEnd: () => {
                let orderedIds = [...this.$refs.list.children].map(el => el.dataset.id)
                Livewire.emit('taskReordered', orderedIds)
            }
        });
    }
}"
class="p-4">

<ul class="space-y-2" x-ref="list">

    @foreach($tasks as $task)
        <li
            data-id="{{ $task->id }}"
            class="p-3 bg-gray-100 rounded cursor-move hover:bg-gray-200"
        >
            {{ $task->name }}
        </li>
    @endforeach

</ul>

</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

