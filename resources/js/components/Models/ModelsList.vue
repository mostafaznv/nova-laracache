<template>
    <div>
        <template v-if="data.list?.length">
            <Card v-if="fetching" class="py-12">
                <div class="rounded-lg flex items-center justify-center inset-0 z-30 light">
                    <Loader class="text-gray-300" width="30" />
                </div>
            </Card>

            <template v-else>
                <ModelsListItem
                    v-for="(item, key) in data.list"
                    @refresh="fetch"
                    class="mb-3"
                    :key="key"
                    :data="item"
                />
            </template>
        </template>
    </div>
</template>

<script setup>
import {ref, onBeforeMount} from 'vue'
import ModelsListItem from './ModelsListItem.vue'

const data = ref([])
const fetching = ref(false)


const fetch = () => {
    fetching.value = true

    Nova.request()
        .get('/nova-vendor/nova-laracache/list')
        .then(response => {
            data.value = response.data
        })
        .finally(() => {
            fetching.value = false
        })
}

onBeforeMount(() => {
    fetch()
})
</script>
