<template>
    <div v-if="groups.length">
        <h3 class="text-lg font-bold mb-8">{{ __('nova-laracache.groups') }}</h3>

        <GroupsListItem
            v-for="(item, key) in groups"
            class="mb-3"
            :key="key"
            :data="item"
        />
    </div>
</template>

<script setup>
import GroupsListItem from './GroupsListItem.vue'

const props = defineProps({
    groups: {
        type: Array,
        default: () => [],
    },
})
</script>
