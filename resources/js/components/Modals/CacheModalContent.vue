<template>
    <div>
        <ModalHeader v-text="__(`nova-laracache.modal.${operatesOn}.${type}.title`)" />
        <ModalContent>
            <p class="leading-normal">
                {{ __(`nova-laracache.modal.${operatesOn}.${type}.description`) }}
            </p>

            <template v-if="operatesOn === 'model'">
                <div class="laracache-modal-label-value mt-6 mb-1">
                    <span>{{ __('nova-laracache.model') }}:</span>
                    <span class="rounded px-2 py-1 text-xs text-gray-600">{{ name }}</span>
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
            </template>

            <div v-else class="laracache-modal-label-value mt-6 mb-1">
                <span>{{ __('nova-laracache.group') }}:</span>
                <span class="rounded px-2 py-1 text-xs text-gray-600">{{ name }}</span>
            </div>
        </ModalContent>
    </div>
</template>

<script setup>
const props = defineProps({
    operatesOn: {
        type: String,
        default: 'model',
        validator: value => ['model', 'group'].includes(value)
    },
    type: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    entities: {
        type: Array,
        default: () => []
    }
})
</script>
