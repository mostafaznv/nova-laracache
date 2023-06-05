<template>
    <div class="laracache-list-item toolbar-container">
        <div class="flex items-center justify-between">
            <div class="bg-gray-200 rounded px-3 py-1 text-gray-600">
                {{ entity.name }}
            </div>

            <Status :status="entity.status" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <div class="text-xs">
                <span>{{ __('nova-laracache.expiration') }}: {{ entity.expiration.isPast ? '–' : entity.expiration.diff }}</span>
            </div>

            <Toolbar
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
import Toolbar from '../Toolbar.vue'

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

<style lang="scss" scoped>
.laracache-list-item {
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: solid 1px rgba(var(--colors-gray-200));

    &:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
}
</style>
