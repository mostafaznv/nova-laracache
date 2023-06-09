<template>
    <div>
        <ModelsListItem
            v-for="(item, key) in models"
            @refresh="fetch"
            class="mb-3"
            :key="key"
            :data="item"
        />
    </div>
</template>

<script setup>
import ModelsListItem from './ModelsListItem.vue'

const props = defineProps({
    models: {
        type: Array,
        required: true
    }
})
</script>
