<template>
    <loading-card class="col-span-12 md:col-span-6" :loading="fetching">
        <div class="px-6 py-6">
            <h3 class="mb-3 text-sm font-bold">{{ label }}</h3>

            <div class="text-4xl mb-3">
                <slot />
            </div>

            <div v-if="description" class="text-sm text-gray-500">{{ description }}</div>
        </div>
    </loading-card>
</template>

<script setup>
const props = defineProps({
    label: {
        type: String,
        required: true
    },
    description: {
        type: String,
        default: ''
    },
    fetching: {
        type: Boolean,
        default: false
    }
})
</script>
