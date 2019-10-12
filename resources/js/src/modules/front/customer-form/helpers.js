import { SATURDAY_END_TIME, WORK_DAY_END_TIME, SATURDAY, SUNDAY } from "./config";

/**
 *
 * @param startTime
 * @param endTime
 * @returns {boolean}
 */
export function isOpen (startTime, endTime) {
   const currentDate = new Date()

    const startDate = new Date(currentDate.getTime());
    startDate.setHours(startTime.split(":")[0]);
    startDate.setMinutes(startTime.split(":")[1]);

    const endDate = new Date(currentDate.getTime());
    endDate.setHours(endTime.split(":")[0]);
    endDate.setMinutes(endTime.split(":")[1]);


    return startDate < currentDate && endDate > currentDate && currentDate.getDay() !== SUNDAY
}

/**
 *
 * @returns {string}
 */
export function getEndTime() {
    const today = new Date()

    return today.getDay() === SATURDAY ? SATURDAY_END_TIME : WORK_DAY_END_TIME
}
