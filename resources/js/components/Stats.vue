<template>
    <div class="grid md:grid-cols-12 gap-6">
        <Card
            :label="__('nova-laracache.stats.models.title')"
            :description="__('nova-laracache.stats.models.desc')"
            :fetching="fetching"
        >
            <span>{{ data.usage || '—' }}</span>
        </Card>

        <Card
            :label="__('nova-laracache.stats.entities.title')"
            :description="__('nova-laracache.stats.entities.desc')"
            :fetching="fetching"
        >
            <span>{{ data.entities || '—' }}</span>
        </Card>
    </div>
</template>

<script setup>
import {ref} from 'vue'
import Card from './Card.vue'

const data = ref({})
const fetching = ref(false)

fetching.value = true

Nova.request()
    .get('/nova-vendor/nova-laracache/stats')
    .then(response => {
        data.value = response.data
    })
    .finally(() => {
        fetching.value = false
    })
</script>
