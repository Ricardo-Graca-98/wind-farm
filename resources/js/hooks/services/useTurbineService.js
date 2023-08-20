import { useState } from 'react';
import axios from 'axios';

// Enable use of credentials by every axios request
axios.defaults.withCredentials = true;

const useTurbineService = () => {

    const [turbine, setTurbine] = useState([]);
    const [turbines, setTurbines] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async (prefix = '') => {
        setLoading(true);
        setError(false);
        await axios.get(`/api/${prefix}turbines`)
            .then(res => {
                setTurbines(res.data.data);
            })
            .catch(err => {
                setError(err);
            });
        setLoading(false);
    }

    const show = async (turbineID) => {
        setLoading(true);
        await axios.get(`/api/turbines/${turbineID}`)
            .then(res => {
                setTurbine(res.data.data);
            })
            .catch(err => {
                setError(err);
            });

        setLoading(false);
    }

    return { index, show, turbine, turbines, loading, error };

}
export default useTurbineService;
