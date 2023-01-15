export function UserReducer(state = false, action) {
    switch (action.type) {
        case "LOG_USER":
            sessionStorage.setItem('jwt', action.payload.jwt)
            return action.payload

        case "LOGOUT_USER":
            sessionStorage.removeItem('jwt')
            return false

        case "RESTORE_SESSION":
            return action.payload

        default:
            return state
    }
}