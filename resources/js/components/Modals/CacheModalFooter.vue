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

            <DefaultButton
                ref="confirmButton"
                class="submit-button"
                :disabled="working"
                :class="submitButtonClass"
                type="submit"
            >
                <Loader v-if="working" width="22" />
                <template v-else>
                    {{ __(`nova-laracache.modal.${type}.submit`) }}
                </template>
            </DefaultButton>
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

const submitButtonClass = computed(() => {
    return props.type === 'delete'
        ? 'bg-red-500 hover:bg-red-400 text-white dark:text-gray-900'
        : ''
})
</script>

<style lang="scss" scoped>
.submit-button {
    min-width: 90px;
}
</style>
