class AppStorage {
    // store token to local storage
    storeToken(token){
        localStorage.setItem('token', token);
    }

    // store user to local storage
    storeUser(user){
        localStorage.setItem('user', user);
    }

    // store token and user to local storage
    store(token, user){
        this.storeToken(token);
        this.storeUser(user);
    }

    // clear local storage
    clear(){
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

    // get token from local storage
    getToken(){
        return localStorage.getItem('token');
    }

    // get user from local storage
    getUser(){
        return localStorage.getItem('user');
    }
}

export default AppStorage = new AppStorage();
