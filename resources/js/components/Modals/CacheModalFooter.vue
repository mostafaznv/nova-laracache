<template>
    <ModalFooter>
        <div class="ml-auto">
            <Button
                @click.prevent="$emit('close')"
                variant="ghost"
                type="button"
                data-testid="cancel-button"
                class="mr-3"
            >
                {{ __('Cancel') }}
            </Button>

            <Button
                ref="confirmButton"
                type="submit"
                class="submit-button"
                :variant="type === 'cancel' ? 'danger' : 'solid'"
                :disabled="working"
            >
                <Loader v-if="working" width="22" />
                <template v-else>
                    {{ __(`nova-laracache.modal.${type}.submit`) }}
                </template>
            </Button>
        </div>
    </ModalFooter>
</template>

<script setup>
import {Button} from 'laravel-nova-ui'

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
</script>

<style lang="scss" scoped>
.submit-button {
    min-width: 90px;
}
</style>
