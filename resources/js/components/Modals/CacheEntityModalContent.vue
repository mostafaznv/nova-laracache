<template>
    <div>
        <ModalHeader v-text="__(`nova-laracache.modal.${type}.title`)" />
        <ModalContent>
            <p class="leading-normal">
                {{ __(`nova-laracache.modal.${type}.description`) }}
            </p>

            <div class="laracache-modal-label-value mt-6 mb-1">
                <span>{{ __('nova-laracache.model') }}:</span>
                <span class="rounded px-2 py-1 text-xs text-gray-600">{{ model }}</span>
            </div>

            <div class="laracache-modal-label-value mb-3">
                <span>{{ __('nova-laracache.entities') }}:</span>
                <span
                    v-for="(entity, key) in entities"
                    class="bg-gray-100 rounded px-2 py-1 text-xs text-gray-600"
                    :key="key"
                >
                    {{ entity }}
                </span>
            </div>
        </ModalContent>
    </div>
</template>

<script setup>
const props = defineProps({
    type: {
        type: String,
        required: true
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
</script>
