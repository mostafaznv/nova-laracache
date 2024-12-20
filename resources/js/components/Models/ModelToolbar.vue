<template>
    <div class="toolbar-buttons">
        <button
            @click="emit('delete')"
            v-tooltip.hover="__('nova-laracache.delete')"
            class="hover:text-primary-500 px-1"
            :aria-label="__('nova-laracache.delete')"
        >
            <Icon name="trash" type="mini" />
        </button>

        <button
            v-tooltip.hover="__('nova-laracache.refresh')"
            @click="emit('refresh')"
            class="hover:text-primary-500 px-1"
            :aria-label="__('nova-laracache.refresh')"
        >
            <Icon name="refresh" type="mini" />
        </button>

        <button
            v-if="!withoutView"
            v-tooltip.hover="__('nova-laracache.view')"
            @click="emit('view')"
            class="hover:text-primary-500 px-1"
            :aria-label="__('nova-laracache.view')"
        >
            <Icon name="eye" type="mini" />
        </button>
    </div>
</template>

<script setup>
import {Icon} from 'laravel-nova-ui'

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
    },
    withoutView: {
        type: Boolean,
        default: false
    }
})

const emit = (event) => {
    $emit(event, {
        model: props.model,
        entities: props.entities
    })
}
</script>

