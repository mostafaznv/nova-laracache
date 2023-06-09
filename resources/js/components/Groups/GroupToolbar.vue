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
    </div>
</template>

<script setup>
const $emit = defineEmits([
    'view', 'refresh', 'delete'
])

const props = defineProps({
    group: {
        type: String,
        required: true
    }
})

const emit = (event) => {
    $emit(event, props.group)
}
</script>

