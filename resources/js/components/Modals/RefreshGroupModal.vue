<template>
    <Modal data-testid="delete-cache-entity-modal" role="alertdialog" size="sm" :show="show">
        <form
            @submit.prevent="handleConfirm"
            class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden"
        >
            <slot>
                <CacheModalContent type="refresh" operates-on="group" :name="group"/>
            </slot>

            <CacheModalFooter @close="handleClose" type="refresh" :working="working" />
        </form>
    </Modal>
</template>

<script setup>
import {ref} from 'vue'
import CacheModalContent from './CacheModalContent.vue'
import CacheModalFooter from './CacheModalFooter.vue'

const emit = defineEmits(['confirm', 'close'])

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    group: {
        type: String,
        required: true
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
        group: props.group
    }

    Nova.request()
        .post('/nova-vendor/nova-laracache/group/refresh', payload)
        .then(() => {
            emit('confirm')
            handleClose()
        })
        .finally(() => {
            working.value = false
        })
}
</script>
