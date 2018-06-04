import React from 'react';
import parseHydraDocumentation from '@api-platform/api-doc-parser/lib/hydra/parseHydraDocumentation';
import { HydraAdmin, hydraClient, fetchHydra as baseFetchHydra } from '@api-platform/admin';
import authClient from './authClient';
import { Redirect } from 'react-router-dom';

const entrypoint = 'http://localhost:8080'; // Change this by your own entrypoint
const fetchHeaders = {'Authorization': `Bearer ${window.localStorage.getItem('token')}`};
const fetchHydra = (url, options = {}) => baseFetchHydra(url, {
    ...options,
    headers: new Headers(fetchHeaders),
});
const restClient = api => hydraClient(api, fetchHydra);
const apiDocumentationParser = entrypoint => parseHydraDocumentation(entrypoint, { headers: new Headers(fetchHeaders) })
    .then(
        ({ api }) => ({ api }),
        (result) => {
            switch (result.status) {
                case 401:
                    return Promise.resolve({
                        api: result.api,
                        customRoutes: [{
                            props: {
                                path: '/',
                                render: () => <Redirect to={`/login`}/>,
                    },
            }],
        });

        default:
            return Promise.reject(result);
        }
        },
    );

export default props => (
    <HydraAdmin
        apiDocumentationParser={apiDocumentationParser}
        authClient={authClient}
        entrypoint={entrypoint}
        restClient={restClient}
    />
);