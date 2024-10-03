import { useState } from 'react';
import Header from '../../components/Header';
import Footer from '../../components/Footer';
import axios from "axios";
import $ from "jquery";


const Support = () => {

    const [firstName, setFirstName] = useState('');

    const raiseTicket = e => {
        e.preventDefault();

        axios.defaults.headers.common['X-WP-Nonce'] = OPTIONS_AUTOLOAD_MANAGER.rest_nonce;

        axios
        .get(OPTIONS_AUTOLOAD_MANAGER.api_base + 'options-autoload-manager/v1/option/get', { params: {
            user_id: 1,
            key: 'admin_email',
            default: 'invalid@email.com',
            single: true,
        } } )
        .then((res) => {
            console.log(res)
        });
    }

    return (
        <div className="wrap">
            <Header />
            
            <form onSubmit={raiseTicket} method="post">
                <p>
                    <input type="text" name="first_name" placeholder="Your Name" onChange={ (e) => setFirstName(e.target.value) } value={firstName} required />
                </p>
                <p>
                    <textarea placeholder="Please elaborate on the issue you're facing"></textarea>
                </p>
                <p>
                    <input type="submit" value="Send" />
                </p>
            </form>

            <Footer />
        </div>
    );
};

export default Support;
