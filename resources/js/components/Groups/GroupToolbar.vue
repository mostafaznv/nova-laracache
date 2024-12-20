<template>
    <div class="toolbar-buttons">
        <button
            v-tooltip.hover="__('nova-laracache.delete')"
            @click="emit('delete')"
            class="hover:text-primary-500 px-2"
            :aria-label="__('nova-laracache.delete')"
        >
            <Icon name="trash" type="solid" />
        </button>

        <button
            v-tooltip.hover="__('nova-laracache.refresh')"
            @click="emit('refresh')"
            class="hover:text-primary-500 px-2"
            :aria-label="__('nova-laracache.refresh')"
        >
            <Icon name="arrow-path" type="solid" />
        </button>
    </div>
</template>

<script setup>
import {Icon} from 'laravel-nova-ui'

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

