<template>
    <Modal data-testid="delete-cache-entity-modal" role="alertdialog" size="4xl" :show="show">
        <form
            @submit.prevent="handleConfirm"
            class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden"
        >
            <slot>
                <ModalHeader
                    v-text="`${model.split('\\').pop()} – ${entities[0]}`"
                />

                <ModalContent>
                    <Card v-if="working" class="py-12 shadow-none">
                        <div class="rounded-lg flex items-center justify-center inset-0 z-30 light">
                            <Loader class="text-gray-300" width="30" />
                        </div>
                    </Card>

                    <template v-else-if="entity.status">
                        <div>
                            <div class="flex mb-1">
                                <Status :status="entity.status" with-background />
                            </div>

                            <div class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                <span class="mr-1">{{ __('nova-laracache.expiration') }}:</span>
                                <span>{{ entity.expiration.isPast ? '–' : entity.expiration.diff }}</span>
                            </div>

                            <div v-if="fluentTtl" class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                <span>{{ __(fluentTtl) }}</span>
                            </div>

                            <div v-if="entity.isQueueable" class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                <span class="mr-1">{{ __('nova-laracache.is-queueable') }}:</span>
                            </div>

                            <div>
                                <div v-if="entity.refreshAfter.create"  class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                    <Icon type="badge-check" solid />
                                    <span class="ml-1">{{ __('nova-laracache.refresh-after.create') }}</span>
                                </div>

                                <div v-if="entity.refreshAfter.update" class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                    <Icon type="badge-check" solid />
                                    <span class="ml-1">{{ __('nova-laracache.refresh-after.update') }}</span>
                                </div>

                                <div v-if="entity.refreshAfter.delete" class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                    <Icon type="badge-check" solid />
                                    <span class="ml-1">{{ __('nova-laracache.refresh-after.delete') }}</span>
                                </div>

                                <div v-if="entity.refreshAfter.restore" class="bg-gray-200 inline-flex rounded px-3 py-1 text-sm text-gray-600 mr-1 mb-1">
                                    <Icon type="badge-check" solid />
                                    <span class="ml-1">{{ __('nova-laracache.refresh-after.restore') }}</span>
                                </div>
                            </div>
                        </div>

                        <div v-if="entity.value.content" class="bg-gray-50 rounded px-3 py-3 text-gray-600 mt-6">
                            <code>
                                <pre class="mb-3 text-red-400 text-xs">{{ entity.value.type }}</pre>
                                <pre>{{ entity.value.content }}</pre>
                            </code>
                        </div>
                    </template>
                </ModalContent>
            </slot>

            <ModalFooter>
                <div class="ml-auto">
                    <LinkButton
                        type="button"
                        data-testid="cancel-button"
                        @click.prevent="$emit('close')"
                        class="mr-3"
                    >
                        {{ __('Close') }}
                    </LinkButton>
                </div>
            </ModalFooter>
        </form>
    </Modal>
</template>

<script setup>
import {ref, watch, computed} from 'vue'
import Status from '../Status.vue'

const emit = defineEmits(['close'])

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
const entity = ref({})


const fluentTtl = computed(() => {
    if (entity.value.forever) {
        return 'nova-laracache.valid-forever'
    }

    if (entity.value.validForRestOfDay) {
        return 'nova-laracache.valid-for-day'
    }

    if (entity.value.validForRestOfWeek) {
        return 'nova-laracache.valid-for-week'
    }

    return null
})

watch(() => props.show, async (show) => {
    if (show) {
        working.value = true

        const payload = {
            params: {
                model: encodeURIComponent(props.model),
                entity: encodeURIComponent(props.entities[0])
            }
        }

        Nova.request()
          .get('/nova-vendor/nova-laracache/entity/show', payload)
          .then(response => {
              entity.value = response.data.entity
          })
          .finally(() => {
              working.value = false
          })
    }
    else {
        entity.value = {}
        working.value = false
    }
})

const handleClose = () => {
    emit('close')
    working.value = false
}
</script>
