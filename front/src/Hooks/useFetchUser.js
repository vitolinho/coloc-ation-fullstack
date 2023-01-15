export function useFetchUser() {
    return async (username, password) => {
        try {
            let data = await fetch('http://localhost:2345/login',
                {
                    method: 'POST',
                    credentials: 'include',
                    headers: new Headers({
                        "Content-type": "application/json"
                    }),
                    body: JSON.stringify({
                        username: username,
                        password: password
                    }),
                    mode: 'cors'
                }
            )

            let json = await data.json()
            let userDecoded = JSON.parse(atob(json.token.split('.')[1]))

            return {
                user: userDecoded,
                jwt: json.token
            }

        } catch (e) {
            return false
        }
    }
}