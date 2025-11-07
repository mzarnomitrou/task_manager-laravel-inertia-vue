
<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

defineProps({
        projects: Object
});


</script>

<template>
    <Head title="Dashboard" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
              Project Dashboard
            </h2>
        </template>

        <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <Link
            v-for="project in projects.data"
            :key="project.id"
            :href="route('projects.show', project.id)"
            class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition duration-200"
          >
            <h3 class="text-lg font-bold mb-2">{{ project.name }}</h3>
            
            <p class="text-sm text-gray-500 mb-4">
              Total Tasks: {{ project.tasks_count }}
            </p>

            <ul class="text-sm">
              <li>Pending: {{ project.pending_tasks_count }}</li>
              <li>In Progress: {{ project.in_progress_tasks_count }}</li>
              <li>Done: {{ project.done_tasks_count }}</li>
            </ul>
          </Link>
        </div>

        
        <Pagination 
          :meta="projects" 
          routeName="projects.index"  />


            </div>
        </div>
    </AuthenticatedLayout>
</template>


