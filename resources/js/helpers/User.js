import Token from './Token';
import AppStorage from './AppStorage';

class User {
    login(data){
        axios.post('/api/auth/login', data)
        .then((result) => {
            this.responseAfterLogin(result)
        })
        .catch((err) => {
            // console.error(err);
        });
    }

    responseAfterLogin(result){
        const access_token = result.data.access_token;
        const username = result.data.user;

        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, username);
            window.location = '/forum';
        }

    }

    hasToken(){
        const storedToken = AppStorage.getToken();

        if (storedToken) {
            return Token.isValid ? true : false;
        }

        return false;
    }

    logedin(){
        return this.hasToken();
    }

    logout(){
        AppStorage.clear();
        window.location = '/forum';
    }

    name(){
        if (this.logedin) {
            return AppStorage.getUser();
        }
    }

    id(){
        if (this.logedin()) {
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }

    own(id){
        return this.id() == id;
    }

    admin(){
        this.id() == 14
    }


}

export default User = new User();
