<template>
    <ModalFooter>
        <div class="ml-auto">
            <LinkButton
                type="button"
                data-testid="cancel-button"
                @click.prevent="$emit('close')"
                class="mr-3"
            >
                {{ __('Cancel') }}
            </LinkButton>

            <LoadingButton
                ref="confirmButton"
                :processing="working"
                :disabled="working"
                :component="submitButtonType"
                type="submit"
            >
                {{ __(`nova-laracache.modal.${type}.submit`) }}
            </LoadingButton>
        </div>
    </ModalFooter>
</template>

<script setup>
import {computed} from 'vue'

const emit = defineEmits(['close'])

const props = defineProps({
    type: {
        type: String,
        required: true
    },
    working: {
        type: Boolean,
        default: false
    }
})

const submitButtonType = computed(() => {
    return props.type === 'delete' ? 'DangerButton' : 'DefaultButton'
})
</script>
