<template>
    <div>
        <div v-for="(model, key) in models" class="laracache-list-item toolbar-container" :key="key">
            <div class="flex items-center justify-between">
                <div class="bg-gray-200 rounded px-3 py-1 text-gray-600">
                    {{ model.model.name }}
                </div>

                <span class="text-xs">{{ model.model.namespace }}</span>
            </div>

            <div class="flex items-center justify-between mt-2">
                <div class="flex items-center">
                    <span>{{ model.entities.join(', ') }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    models: {
        type: Array,
        required: true
    }
})
</script>
