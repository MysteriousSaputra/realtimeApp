import Token from './Token';
import AppStorage from './AppStorage';

class User {
    login(data){
        axios.post('/api/auth/login', data)
        .then((result) => {
            this.responseAfterLogin(result)
        })
        .catch((err) => {
            console.error(err);
        });
    }

    responseAfterLogin(result){
        const access_token = result.data.access_token;
        const username = result.data.user;

        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, username);
        }

    }

    hasToken(){
        const storedToken = AppStorage.getToken;

        if (storedToken) {
            return Token.isValid ? true : falsw;
        }

        return false;
    }
}

export default User = new User();
