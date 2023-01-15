export function logUser(userObject) {
    return {
        type: "LOG_USER",
        payload: userObject
      }
}