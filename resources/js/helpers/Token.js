class Token{
    // check if payload is valid
    isValid(token){
        const payload = this.payload(token);
        if (payload) {
            return payload.iss == "http://127.0.0.1:8000/api/auth/login" || payload.iss == "http://127.0.0.1:8000/api/auth/signup" ? true : false;
        }

        return false;
    }

    // payload
    payload(token){
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    // decode payload
    decode(payload){
        return JSON.parse(atob(payload));
    }
}

export default Token =  new Token();
