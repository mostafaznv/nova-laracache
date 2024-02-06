<template>
    <div class="flex items-center" :class="['status-' + statusSlug, withBackground ? 'with-bg' : '']">
        <Badge class="whitespace-nowrap flex items-center mx-auto" :title="status">
            <span class="slug mr-3">{{ __(statusSlug) }}</span>

            <div>
                <Icon
                    v-if="status === 'NOT_CREATED'"
                    type="minus-circle"
                    :solid="true"
                />

                <Loader
                    v-else-if="status === 'CREATING'"
                    width="20"
                />

                <Icon
                    v-if="status === 'DELETED'"
                    type="exclamation-circle"
                    style="fill: rgb(239,68,68)"
                    :solid="true"
                />

                <Icon
                    v-if="status === 'CREATED'"
                    type="check-circle"
                    :solid="true"
                />
            </div>
        </Badge>
    </div>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    status: {
        type: String,
        required: true,
        validate: value => ['NOT_CREATED', 'CREATING', 'CREATED', 'DELETED'].includes(value)
    },
    withBackground: {
        type: Boolean,
        default: false
    }
})

const statusSlug = computed(() => {
    return props.status.toLowerCase().replace('_', '-')
})
</script>

<style lang="scss" scoped>
.status-not-created {
    .slug {
        color: rgba(var(--colors-yellow-800));
    }

    svg {
        fill: rgba(var(--colors-yellow-400));
    }

    &.with-bg {
        background-color: rgba(var(--colors-yellow-400));
    }
}

.status-created {
    .slug {
        color: rgba(var(--colors-green-700));
    }

    svg {
        fill: rgba(var(--colors-green-400));
    }

    &.with-bg {
        background-color: rgba(var(--colors-green-400));

    }
}

.status-deleted {
    .slug {
        color: rgba(var(--colors-red-700));
    }

    svg {
        fill: rgba(var(--colors-red-400));
    }

    &.with-bg {
        background-color: rgba(var(--colors-red-400));
    }
}

.with-bg {
    border-radius: 0.25rem;
    min-height: 28px;

    .slug {
        color: white !important;
    }

    svg {
        fill: white !important;
    }
}
</style>
