export function get_read_time(element){
    const $ = window.jQuery;
    const words_per_minute = 150; 
    const text = $(element).text().trim();
    const words_count = text.split(/\s+/).length; 

    const real_total_minutes = words_count / words_per_minute;
    if (real_total_minutes > 0 && real_total_minutes < 1) {
        return 'Меньше минуты';
    }
    const total_minutes = Math.round(real_total_minutes);
    const hours = Math.floor(total_minutes / 60);
    const minutes = total_minutes % 60;

    if (hours > 0) {
        return `${hours} ${hourText(hours)} ${minutes} ${minuteText(minutes)}`;
    } else {
        return `${minutes} ${minuteText(minutes)}`;
    }
}

function minuteText(n) {
    n = Math.abs(n) % 100;
    const n1 = n % 10;
    if (n > 10 && n < 20) return 'минут';
    if (n1 === 1) return 'минута';
    if (n1 >= 2 && n1 <= 4) return 'минуты';
    return 'минут';
}

function hourText(n) {
    n = Math.abs(n) % 100;
    const n1 = n % 10;
    if (n > 10 && n < 20) return 'часов';
    if (n1 === 1) return 'час';
    if (n1 >= 2 && n1 <= 4) return 'часа';
    return 'часов';
}
