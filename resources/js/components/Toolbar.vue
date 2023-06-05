<template>
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
</template>

<script setup>
const $emit = defineEmits([
    'view', 'refresh', 'delete'
])

const props = defineProps({
    model: {
        type: String,
        required: true
    },
    entities: {
        type: Array,
        default: () => []
    }
})

const emit = (event) => {
    $emit(event, {
        model: props.model,
        entities: props.entities
    })
}
</script>

