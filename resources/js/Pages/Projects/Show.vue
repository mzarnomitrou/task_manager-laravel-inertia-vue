<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import TaskTable from '@/Components/TaskTable.vue';
import TaskForm from '@/Components/TaskForm.vue';
//import { router } from '@inertiajs/vue3';

defineProps({
    project: Object,
    tasks: {
        type: Object,
        default: () => ({ data: [], meta: {} })
    },
    users: {
        type: Object,
        default: () => []
    },
    statusList: Object,
    
});

const showFormModal = ref(false)
const editingTask = ref(null)


function openTaskForm() {
  editingTask.value = null
  showFormModal.value = true
}

function editTask(task) {
  editingTask.value = task
  showFormModal.value = true
}

function closeTaskForm() {
  showFormModal.value = false
}

//Create new task or edited task
function saveTask(taskData) {
  if (editingTask.value) {
    Inertia.put(`/tasks/${editingTask.value.id}`, taskData, {
      onSuccess: () => {
        showFormModal.value = false;
        Inertia.replace(route('projects.show', { project: project.id }), {
          preserveState: true,
        });
      }
    })
    
  } else {
    Inertia.post('/tasks',taskData, {
        onSuccess: () => {
            showFormModal.value = false;
        }
    });
    
  }

  showFormModal.value = false
}


function deleteTask(task) {
 
    if (confirm('Are you sure you want to delete this project?')) {
        Inertia.delete(route('tasks.destroy', task), {
          onSuccess: (response) => {
              //router.reload({ only:['tasks']});
              this.tasks = this.tasks.filter(t => t.id !== task.id);
          },
          onError: (error) => {
            
          }
        });
      }
}



</script>

<template>
    <Head title="Dashboard" />
    
    <AuthenticatedLayout>

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ project.name }}
            </h2>
        </template>
        

        <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <p>{{ project.description }}</p>
            <TaskTable :tasks="tasks.data"
                :meta="tasks.meta"
                :project="project"
                @add="openTaskForm()" 
                @edit="editTask" 
                @delete="deleteTask" >
            </TaskTable>

            
        <!-- TaskForm Modal -->
        <div v-if="showFormModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-96 relative">
        <button @click="closeTaskForm()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✕</button>
        
         <TaskForm 
          :task="editingTask" 
          :users="users"
          :statusList="statusList"
          :projectId="project.id"
          @submit="saveTask"
        />
        </div>
        </div>

        </div>
        </div>

    </AuthenticatedLayout>
</template>