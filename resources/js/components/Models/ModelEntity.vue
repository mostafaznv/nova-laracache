<template>
    <div class="laracache-list-item toolbar-container">
        <div class="flex items-center justify-between">
            <div class="bg-gray-200 rounded px-3 py-1 text-gray-600">
                {{ __(entity.name) }}
            </div>

            <Status :status="entity.status" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <div class="flex items-center text-xs">
                <span class="mr-1">{{ __('nova-laracache.expiration') }}:</span>
                <span>{{ entity.expiration.isPast || entity.status !== 'CREATED' ? '–' : entity.expiration.diff }}</span>
            </div>

            <ModelToolbar
                @view="$emit('view', $event)"
                @refresh="$emit('refresh', $event)"
                @delete="$emit('delete', $event)"
                :model="model.namespace"
                :entities="[entity.name]"
            />
        </div>
    </div>
</template>

<script setup>
import Status from '../Status.vue'
import ModelToolbar from './ModelToolbar.vue'

const $emit = defineEmits([
    'view', 'refresh', 'delete'
])

const props = defineProps({
    entity: {
        type: Object,
        required: true
    },
    model: {
        type: Object,
        required: true
    }
})
</script>
