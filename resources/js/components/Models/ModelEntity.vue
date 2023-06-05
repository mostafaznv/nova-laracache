<template>
    <div class="laracache-list-item">
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

            <div class="toolbar-buttons">
                <button
                    v-tooltip.hover="__('nova-laracache.delete')"
                    @click="emit('delete')"
                    class="hover:text-primary-500 px-2"
                    :aria-label="__('nova-laracache.delete')"
                >
                    <Icon type="trash" solid />
                </button>

                <button
                    v-tooltip.hover="__('nova-laracache.refresh')"
                    @click="emit('refresh')"
                    class="hover:text-primary-500 px-2"
                    :aria-label="__('nova-laracache.refresh')"
                >
                    <Icon type="refresh" solid />
                </button>

                <button
                    v-tooltip.hover="__('nova-laracache.view')"
                    @click="emit('view')"
                    class="hover:text-primary-500 px-2"
                    :aria-label="__('nova-laracache.view')"
                >
                    <Icon type="eye" solid />
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import Status from '../Status.vue'

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

const emit = (event) => {
    $emit(event, {
        model: props.model.namespace,
        entities: [props.entity.name]
    })
}
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

    .toolbar-buttons {
        opacity: 0;
        transition: all 300ms;
    }

    &:hover {
        .toolbar-buttons {
            opacity: 1;
        }
    }
}
</style>
