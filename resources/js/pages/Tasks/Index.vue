<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { AppPageProps, type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
interface Task {
    id: number;
    title: string;
    description: string;
    status: string;
}
defineProps<{
    tasks: Task[];
}>();
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tasks',
        href: route('tasks.index'),
    },
];
const page = usePage<AppPageProps>();
</script>
<template>
    <Head title="Dashboard" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <h1 class="mb-4 text-2xl">My Tasks</h1>

            <div v-if="page.props.flash.status" class="mb-4 border-l-4 border-green-500 bg-green-100 p-4 text-green-700">
                {{ page.props.flash.status }}
            </div>

            <div class="mb-4">
                <Link href="/tasks/create" class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600"> Create New Task </Link>
            </div>

            <div v-if="tasks.length === 0" class="text-gray-500">No tasks yet. Create one!</div>

            <ul v-else>
                <li v-for="task in tasks" :key="task.id" class="border-b py-2">
                    <strong>{{ task.title }}</strong>
                    <p class="text-sm text-gray-600">{{ task.description }}</p>
                    <span class="text-xs text-gray-500">{{ task.status }}</span>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
