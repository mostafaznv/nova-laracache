<template>
    <Card class="col-span-12">
        <div class="px-6 py-6">
            <div class="toolbar-container flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <h3 class="text-lg font-bold">{{ data.model.name }}</h3>

                    <ModelToolbar
                        @view="openModal('view', $event)"
                        @delete="openModal('delete', $event)"
                        @refresh="openModal('refresh', $event)"
                        class="ml-3"
                        :model="data.model.namespace"
                        :entities="entitiesList"
                        :without-view="true"
                    />
                </div>

                <span class="text-xs">{{ data.model.namespace }}</span>
            </div>

            <div class="mb-3 mt-6">
                <ModelEntity
                    v-for="(entity, key) in data.entities"
                    @view="openModal('view', $event)"
                    @delete="openModal('delete', $event)"
                    @refresh="openModal('refresh', $event)"
                    :key="key"
                    :model="data.model"
                    :entity="entity"
                />
            </div>
        </div>

        <ViewCacheEntityModal
            @close="closeModal('view')"
            :show="viewModalOpen"
            :model="model"
            :entities="entities"
        />

        <DeleteCacheEntityModal
            @confirm="refresh"
            @close="closeModal('delete')"
            :show="deleteModalOpen"
            :model="model"
            :entities="entities"
        />

        <RefreshCacheEntityModal
            @confirm="refresh"
            @close="closeModal('refresh')"
            :show="refreshModalOpen"
            :model="model"
            :entities="entities"
        />
    </Card>
</template>

<script setup>
import {ref, computed} from 'vue'
import ModelEntity from './ModelEntity.vue'
import DeleteCacheEntityModal from '../Modals/DeleteCacheEntityModal.vue'
import RefreshCacheEntityModal from '../Modals/RefreshCacheEntityModal.vue'
import ViewCacheEntityModal from '../Modals/ViewCacheEntityModal.vue'
import ModelToolbar from './ModelToolbar.vue'
import __ from '../../../../vendor/laravel/nova/resources/js/util/localization'

const model = ref('')
const entities = ref([])
const viewModalOpen = ref(false)
const deleteModalOpen = ref(false)
const refreshModalOpen = ref(false)

const emit = defineEmits(['refresh'])

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
})

const entitiesList = computed(() => {
    return props.data.entities.map(entity => entity.name)
})

const openModal = (modal, data) => {
    model.value = data.model
    entities.value = data.entities

    if (modal === 'view') {
        viewModalOpen.value = true
    }
    else if (modal === 'delete') {
        deleteModalOpen.value = true
    }
    else if (modal === 'refresh') {
        refreshModalOpen.value = true
    }
}

const closeModal = (modal) => {
    model.value = ''
    entities.value = []

    if (modal === 'view') {
        viewModalOpen.value = false
    }
    else if (modal === 'delete') {
        deleteModalOpen.value = false
    }
    else if (modal === 'refresh') {
        refreshModalOpen.value = false
    }
}

const refresh = () => {
    Nova.success(__('nova-laracache.modal.success-msg'))
    // emit('refresh')
}

</script>

