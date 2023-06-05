<template>
    <Modal data-testid="delete-cache-entity-modal" role="alertdialog" size="sm" :show="show">
        <form
            @submit.prevent="handleConfirm"
            class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden"
        >
            <slot>
                <CacheEntityModalContent
                    type="refresh"
                    :model="model"
                    :entities="entities"
                />
            </slot>

            <CacheEntityModalFooter
                @close="handleClose"
                type="refresh"
                :working="working"
            />
        </form>
    </Modal>
</template>

<script setup>
import {ref} from 'vue'
import CacheEntityModalContent from './CacheEntityModalContent.vue';
import CacheEntityModalFooter from './CacheEntityModalFooter.vue'

const emit = defineEmits(['confirm', 'close'])

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    model: {
        type: String,
        required: true
    },
    entities: {
        type: Array,
        default: () => []
    }
})

const working = ref(false)


const handleClose = () => {
    emit('close')
    working.value = false
}

const handleConfirm = () => {
    working.value = true

    const payload = {
        model: props.model,
        entities: props.entities
    }

    Nova.request()
        .post('/nova-vendor/nova-laracache/entity/refresh', payload)
        .then(() => {
            emit('confirm')
            handleClose()
        })
        .finally(() => {
            working.value = false
        })
}
</script>
