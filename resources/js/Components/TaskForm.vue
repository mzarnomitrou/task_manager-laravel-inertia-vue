<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
    task: Object,       
    users: { type: Object, required: true }, 
    statusList: Object,
    projectId: { type: [String, Number], required: true }
});

const emit = defineEmits(['submit']);

const form = ref({
  title: props.task?.title || '',
  status: props.task?.status || 'pending',
  assigned_to: props.task?.assigned_to?.id || '',
  due_date: props.task?.due_date || '',
  project_id: props.projectId,
});


watch(() => props.task, (newTask) => {
  form.value = {
    title: newTask?.title || '',
    status: newTask?.status || 'pending',
    assigned_to: newTask?.assigned_to?.id || '',
    due_date: newTask?.due_date || '',
    project_id: props.projectId
  }
});
</script>


<template>
  <form @submit.prevent="$emit('submit', form)" class="space-y-3">
    
    <input
      v-model="form.title"
      type="text"
      placeholder="Task title"
      class="border rounded px-2 py-1 w-full"
      required
    />

    <select 
        v-model="form.status" 
        class="border rounded px-2 py-1 w-full">
        <option v-for="status in statusList" :key="status" :value="status">
            {{ status }}
        </option>
    </select>

    <select 
        v-model="form.assigned_to" 
        class="border rounded px-2 py-1 w-full">
        <option :value="null">Unassigned</option>
        <option v-for="user in users.data" :key="user.id" :value="user.id">
            {{ user.name }}
        </option>
    </select>

    <input
      v-model="form.due_date"
      type="date" 
      class="border rounded px-2 py-1 w-full"
      :placeholder="'Select Due Date'"
    />

    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 w-full">
      {{ props.task ? 'Update Task' : 'Create Task' }}
    </button>

  </form>
</template>
