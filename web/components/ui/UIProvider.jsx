import { defineComponent, TransitionGroup } from "vue"
import { MessageType } from "@/provider"
import ToastMessage from "@/components/ui/toast/Message.vue"
import ToastNotification from "@/components/ui/toast/Notification.vue"

// https://vuejs.org/guide/extras/render-function.html#basic-usage
export default defineComponent({
    name: 'UIProvider',
    render: function () {
        return (
            <div id="layout-wrapper">
                {this.$slots.default()}

                <TransitionGroup
                    name="fadeInDown"
                    class="toast-container position-fixed" 
                    style="top: 1rem; right: 1rem; z-index: 9999"
                    tag="div"
                    key="toast-container"
                >
                    {
                        this.$Toast.messagesList.value.map(
                            message => message.type !== MessageType.INFO
                            ? <ToastMessage key={message.id} message={message} />
                            : <ToastNotification key={message.id} message={message} />
                        )
                    }
                </TransitionGroup>
            </div>
        )
    }
})

