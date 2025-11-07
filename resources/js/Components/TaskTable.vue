<script setup>
    import { TrashIcon, PencilIcon} from '@heroicons/vue/24/solid';
    import Pagination from '@/Components/Pagination.vue';

    defineProps({
    tasks: {
        type: Array,
        default: () => []
    },
    meta: {
        type: Object,
        default: () => ({})
    },
    })
</script>

<template>
  <div>

    <div class="flex justify-end mb-4">
    <button 
        @click="$emit('add')" 
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Add Task
    </button>
    </div>

    <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden divide-y divide-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th>Title</th>
          <th>Status</th>
          <th>Assigned To</th>
          <th>Due date</th>
          <th>Actions</th>
        </tr>
      </thead>
     
      <tbody>
        <tr v-for="task in tasks" :key="task.id" class="px-6 py-3 text-center">
          <td >{{ task.title }}</td>
          <td >{{ task.status }}</td>
          <td >{{ task.assigned_to?.name || '—' }}</td>
          <td > {{ task.due_date }}</td>
          <td >
            <button @click="$emit('edit', task)" class="text-blue-500 hover:text-blue-700 mx-2">
                <PencilIcon class="w-5 h-5" />
            </button>
            <button @click="$emit('delete', task)" class="text-red-500 hover:text-red-700 mx-2">
                <TrashIcon class="w-5 h-5" />
            </button>
          </td>
        </tr>

        <tr v-if="tasks.length === 0">
          <td colspan="5">No tasks found.</td>
        </tr>
      </tbody>
    </table>

    
    <Pagination 
        :meta="meta" 
        routeName="projects.show"  />


  </div>
</template>