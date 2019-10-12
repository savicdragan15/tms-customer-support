import axios from 'axios'

export const issueService = {
    store
}

function store(data) {
    return axios.post('issues', data)
}
