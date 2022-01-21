import apiClient from '@jodaz_/data-provider';

const providers = apiClient(`http://localhost:8000/api`, {
    withCredentials: true,
    offsetPageNum: 0
}, `${process.env.REACT_APP_AUTH_TOKEN_NAME}`);

export const dataProvider = providers.endpoints;

export const axios = providers.client;
