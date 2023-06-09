<template>
    <div class="nova-laracache">
        <div :class="{ dark }">
            <Head :title="__('nova-laracache.section-name')"/>
            <Heading class="mb-6">{{ __('nova-laracache.section-name') }}</Heading>


            <Stats />

            <div>
                <Card v-if="fetching" class="py-12">
                    <div class="rounded-lg flex items-center justify-center inset-0 z-30 light">
                        <Loader class="text-gray-300" width="30" />
                    </div>
                </Card>

                <template v-else>
                    <ModelsList class="mt-8" :models="data.models || []"/>
                    <GroupsList class="mt-8" :groups="data.groups || []"/>
                </template>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onBeforeMount, ref} from 'vue'
import Stats from '../components/Stats.vue'
import ModelsList from '../components/Models/ModelsList.vue'
import GroupsList from '../components/Groups/GroupsList.vue'

const data = ref({})
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
