<template>
    <Card class="toolbar-container col-span-12">
        <div class="px-6 py-6">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-bold">{{ data.group.name }}</h3>

                <GroupToolbar
                    @delete="openModal('delete', $event)"
                    @refresh="openModal('refresh', $event)"
                    class="ml-3"
                    :group="data.group.slug"
                />
            </div>

            <div class="mb-3 mt-6">
                <GroupModels :models="data.models"/>
            </div>
        </div>

        <DeleteGroupModal
            @confirm="refresh"
            @close="closeModal('delete')"
            :show="deleteModalOpen"
            :group="group"
        />

        <RefreshGroupModal
            @confirm="refresh"
            @close="closeModal('refresh')"
            :show="refreshModalOpen"
            :group="group"
        />
    </Card>
</template>

<script setup>
import {ref} from 'vue'
import { useLocalization } from 'laravel-nova'
import GroupModels from './GroupModels.vue'
import DeleteGroupModal from '../Modals/DeleteGroupModal.vue'
import RefreshGroupModal from '../Modals/RefreshGroupModal.vue'
import GroupToolbar from './GroupToolbar.vue'

const group = ref('')
const deleteModalOpen = ref(false)
const refreshModalOpen = ref(false)

const emit = defineEmits(['refresh'])

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
})

const { __ } = useLocalization()

const openModal = (modal, data) => {
    group.value = data

    if (modal === 'refresh') {
        refreshModalOpen.value = true
    }
    else if (modal === 'delete') {
        deleteModalOpen.value = true
    }
}

const closeModal = (modal) => {
    group.value = ''

    if (modal === 'refresh') {
        refreshModalOpen.value = false
    }
    else if (modal === 'delete') {
        deleteModalOpen.value = false
    }
}

const refresh = () => {
    Nova.success(__('nova-laracache.modal.success-msg'))
}

</script>

