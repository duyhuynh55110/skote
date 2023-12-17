import { ref } from "vue"

// message's type
export enum MessageType {
    SUCCESS = "success",
    ERROR = "error",
    WARNING = "warning",
    INFO = "info"
}

// message interface for a object in list
export interface Message {
    // Unique message id
    id: Number

    // message title when use type is info
    title?: String 

    // message text or html 
    content: String

    // type of this message
    type: MessageType 
}

// list message were pushed to toast system
const messagesList:Ref<Array<Message>> = ref([]);

// generate message's id when push to list
const createId = () => {
    let id = Math.random(); 

    do {
        id = Math.random(); 
    } while(messagesList.value.filter(message => message.id === id).length);

    return id;
}

// provide/inject object to contact with system
export const $Toast = {
    messagesList: messagesList,
    success: (content: String) => {
        messagesList.value.push({ id: createId(), content, type: MessageType.SUCCESS });
    },
    warning: (content: String) => {
        messagesList.value.push({ id: createId(), content, type: MessageType.WARNING });
    },
    error: (content: String) => {
        messagesList.value.push({ id: createId(), content, type: MessageType.ERROR });
    },
    info: (title: String, content: String) => {
        messagesList.value.push({ id: createId(), title, content, type: MessageType.INFO });
    },
    removeMessage: (id: Number) => {
        messagesList.value = messagesList.value.filter((message: Message) => message.id !== id);
    }
}