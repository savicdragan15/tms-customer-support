import axios from 'axios'

export const issueService = {
    index,
    destroy
}

function index (page = 1) {
    return axios.get(`admin/issues?page=${page}`)
}

function destroy (id) {
    return axios.delete(`admin/issues/${id}`)
}
