(function($) {

    'use strict';

    let calc = (val) => {
        let { maternityLeaveMonths2, maternityLeaveDays2, maternityLeaveMonths, maternityLeaveDays, precentDisability, partialDisability, TotalDisability, dead, workInjuryMonths, workInjuryDays, sickDays, daysForVacation2, daysForVacation, workHours, additionHours, weeklyRest, delaySaleryMonths, delaySaleryDays, noticePeriodMonths, noticePeriodDays, startWork, endWork, discountDaysFromEnd, discountDaysBefore20, discountDaysAfter20, vacationDaysPaid, salery, saleryPlus, endReason, additionVacation, discountInsurance, treatmentFeesMonthes, treatmentFeesDays, treatmentFeesHalfMonthes, treatmentFeesHalfDays } = val;

        // حساب تاريخ مستحقات مكافاة نهاية الخدمة
        let endDateAward = (startDate, endData, discountDaysFromEnd = 0, salery, saleryPlus = 0, endReason, discountInsurance = 0) => {
            // console.log(salery, endReason, saleryPlus, discountDaysFromEnd, endData, startDate)
            let endTime = new Date(endData);
            let startTime = new Date(startDate);
            let days = 0,
                month = 0,
                years = 0;

            let daysPositive = endTime.getDate() + 1;
            let daysNegative = startTime.getDate() + Number(discountDaysFromEnd);
            console.log(daysPositive, daysNegative, endTime.getDate(), startTime.getDate(), endData, startDate)
            if (daysPositive < daysNegative) {
                month--;
                days = daysPositive + 30 - daysNegative;
            } else {
                days = daysPositive - daysNegative;
            }
            if (days >= 30) {
                month += (days / 30 >> 0);
                days = days % 30;
            }
            let monthPositive = endTime.getMonth() + 1 + month;
            let monthNegative = startTime.getMonth() + 1;
            console.log(monthPositive, monthNegative, endTime.getMonth(), startTime.getMonth(), endData, startDate)
            if (monthPositive < monthNegative) {
                years--;
                month = monthPositive + 12 - monthNegative;
            } else {
                month = monthPositive - monthNegative;
            }
            if (month >= 12) {
                month = month - 12;
                years++;
            }
            years += endTime.getFullYear() - startTime.getFullYear()
            let age = {
                years,
                month,
                days
            };
            // check if he spent more than 5 your before this data
            let spentMoreThan_5_years = 0;
            let isMoreFive = false;
            if (years >= 5) {
                spentMoreThan_5_years = years - 5;
                isMoreFive = true;
            }
            let totalSalery = +salery + +saleryPlus;
            let calcYearsAmount = 0;
            let calcMonthAmount = 0;
            let calcdaysAmount = 0;
            let first_5_years = 0;
            let last_5_years = 0;
            let totalFirst_5_years = 0;
            let totalLast_5_years = 0;
            if (isMoreFive) {
                calcYearsAmount += 5 * (totalSalery / 26) * 15;
                calcMonthAmount += (month / 12) * totalSalery;
                calcdaysAmount += (days / 365) * totalSalery;
                // total amount for first 5 years
                first_5_years = calcYearsAmount;
                // total amount for after 5 years
                last_5_years = spentMoreThan_5_years * totalSalery;
                totalFirst_5_years = calcYearsAmount;
                calcYearsAmount += spentMoreThan_5_years * totalSalery;
                totalLast_5_years = calcYearsAmount + calcMonthAmount + calcdaysAmount;
            } else {
                calcYearsAmount += years * (totalSalery / 26) * 15;
                calcMonthAmount += (month / 12) * (totalSalery / 26) * 15;
                calcdaysAmount += (days / 365) * (totalSalery / 26) * 15;
                first_5_years = years * (totalSalery / 26) * 15;
                totalFirst_5_years = calcYearsAmount + calcMonthAmount + calcdaysAmount;
            }
            // console.log(calcYearsAmount, calcMonthAmount, calcdaysAmount);
            let totalAmount = calcYearsAmount + calcMonthAmount + calcdaysAmount;
            let finalAwardAmount = 0;

            // اذ كان السبب يعود للمدعى عليه
            if (endReason == 2) {
                return {
                    isMoreFive: isMoreFive,
                    age: {
                        title: `المده المستحق`,
                        val: age
                    },
                    totalAmount: {
                        title: `الاجمالى`,
                        total: totalAmount.toFixed(3)
                    },
                    finalAwardAmount: {
                        title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                        total: totalAmount.toFixed(3),
                    },
                    finalAmount: {
                        title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                        total: totalAmount.toFixed(3) - discountInsurance
                    },
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysFromEnd,
                        workDate: Object.assign({}, age),
                        first_5_years: first_5_years.toFixed(3),
                        last_5_years: last_5_years.toFixed(3),
                        calcMonthAmount: calcMonthAmount.toFixed(3),
                        calcdaysAmount: calcdaysAmount.toFixed(3),
                        totalFirst_5_years: totalFirst_5_years.toFixed(3),
                        totalLast_5_years: totalLast_5_years.toFixed(3),
                        spentMoreThan_5_years
                    },
                    reason: `يستحق المدعي اجمالي قيمة مكافاة نهاية الخدمة اذا كانت سبب نهاية الخدمة يعود للمدعى عليها او اذا تجاوزت مدة خدمته 10 سنوات وبحد اقصى راتب سنة ونصف `
                };
            }
            // اذ كان السبب يعود للمدعى وعدد سنوات العمل اقل من 3 سنوات
            if (endReason == 1 && years < 3) {
                return {
                    isMoreFive: isMoreFive,
                    age: {
                        title: `المده المستحق`,
                        val: age
                    },
                    totalAmount: {
                        title: `الاجمالى`,
                        total: totalAmount.toFixed(3)
                    },
                    finalAwardAmount: {
                        title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                        total: finalAwardAmount.toFixed(3)
                    },
                    finalAmount: {
                        title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                        total: finalAwardAmount.toFixed(3) - discountInsurance
                    },
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysFromEnd,
                        workDate: Object.assign({}, age),
                        first_5_years: first_5_years.toFixed(3),
                        last_5_years: last_5_years.toFixed(3),
                        calcMonthAmount: calcMonthAmount.toFixed(3),
                        calcdaysAmount: calcdaysAmount.toFixed(3),
                        totalFirst_5_years: totalFirst_5_years.toFixed(3),
                        totalLast_5_years: totalLast_5_years.toFixed(3),
                        spentMoreThan_5_years
                    },
                    reason: ` اذا كانت خدمة المدعي اقل من 3 سنوات و سبب نهاية الخدمة يعود للمدعي فانه لا يستحق مكافاة نهاية الخدمة`
                };
            }
            // اذا كان السبب يعود للمدعى وعدد سنوات العمل  اكبر من 3 سنوات واقل من 5 سنوات
            if (endReason == 1 && years >= 3 && years < 5) {
                return {
                    isMoreFive: isMoreFive,
                    age: {
                        title: `المده المستحق`,
                        val: age
                    },
                    totalAmount: {
                        title: `الاجمالى`,
                        total: totalAmount.toFixed(3)
                    },
                    finalAwardAmount: {
                        title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                        total: (totalAmount / 2).toFixed(3)
                    },
                    finalAmount: {
                        title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                        total: (totalAmount / 2).toFixed(3) - discountInsurance
                    },
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysFromEnd,
                        workDate: Object.assign({}, age),
                        first_5_years: first_5_years.toFixed(3),
                        last_5_years: last_5_years.toFixed(3),
                        calcMonthAmount: calcMonthAmount.toFixed(3),
                        calcdaysAmount: calcdaysAmount.toFixed(3),
                        totalFirst_5_years: totalFirst_5_years.toFixed(3),
                        totalLast_5_years: totalLast_5_years.toFixed(3),
                        spentMoreThan_5_years
                    },
                    reason: `بما ان خدمة المدعي اقل من 5 سنوات واكثر من 3 سنوات وسبب نهاية الخدمة يعود للمدعي فانه يستحق نصف كافاة نهاية الخدمة `
                };
            }
            // اذا كان السبب يعود للمدعى وعدد سنوات العمل  اكبر من 5 سنوات واقل من 10 سنوات
            if (endReason == 1 && years >= 5 && years < 10) {
                return {
                    isMoreFive: isMoreFive,
                    age: {
                        title: `المده المستحق`,
                        val: age
                    },
                    totalAmount: {
                        title: `الاجمالى`,
                        total: totalAmount.toFixed(3)
                    },
                    finalAwardAmount: {
                        title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                        total: ((totalAmount / 3) * 2).toFixed(3)
                    },
                    finalAmount: {
                        title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                        total: ((totalAmount / 3) * 2).toFixed(3) - discountInsurance
                    },
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysFromEnd,
                        workDate: Object.assign({}, age),
                        first_5_years: first_5_years.toFixed(3),
                        last_5_years: last_5_years.toFixed(3),
                        calcMonthAmount: calcMonthAmount.toFixed(3),
                        calcdaysAmount: calcdaysAmount.toFixed(3),
                        totalFirst_5_years: totalFirst_5_years.toFixed(3),
                        totalLast_5_years: totalLast_5_years.toFixed(3),
                        spentMoreThan_5_years
                    },
                    reason: `بما ان خدمة المدعي اكثر من 5 سنوات واقل من 10 سنوات وسبب نهاية الخدمة يعود للمدعي فانه يستحق ثلثي مكافاة نهاية الخدمة `
                };
            }
            // اذا كان السبب يعود للمدعى وعدد سنوات العمل  اكبر من 10 سنوات
            if (endReason == 1 && years >= 10) {
                return {
                    isMoreFive: isMoreFive,
                    age: {
                        title: `المده المستحق`,
                        val: age
                    },
                    totalAmount: {
                        title: `الاجمالى`,
                        total: totalAmount.toFixed(3)
                    },
                    finalAwardAmount: {
                        title: `الاجمالى بعد معرفه مده العمل وسبب نهايه الخدمه`,
                        total: totalAmount.toFixed(3)
                    },
                    finalAmount: {
                        title: `صافى مكافاة نهاية الخدمة بعد خصم التامينات`,
                        total: totalAmount.toFixed(3) - discountInsurance
                    },
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysFromEnd,
                        workDate: Object.assign({}, age),
                        first_5_years: first_5_years.toFixed(3),
                        last_5_years: last_5_years.toFixed(3),
                        calcMonthAmount: calcMonthAmount.toFixed(3),
                        calcdaysAmount: calcdaysAmount.toFixed(3),
                        totalFirst_5_years: totalFirst_5_years.toFixed(3),
                        totalLast_5_years: totalLast_5_years.toFixed(3),
                        spentMoreThan_5_years
                    },
                    reason: `يستحق المدعي اجمالي قيمة مكافاة نهاية الخدمة اذا كانت سبب نهاية الخدمة يعود للمدعى عليها او اذا تجاوزت مدة خدمته 10 سنوات وبحد اقصى راتب سنة ونصف `
                };
            }
        };
        // حساب رصيد الاجازات
        let calcLawDate = (startDate, endDate, discountDaysBefore20 = 0, discountDaysAfter20 = 0, vacationDaysPaid = 0, salery, additionVacation = 30) => {
            var _a, _b;
            let daysBefore20 = false;
            let daysAfter20 = false;
            let date_20_02_2010 = '02/20/2010';
            let date_21_02_2010 = '02/21/2010';
            //  على القانون القديم
            if (new Date(date_20_02_2010).getTime() > new Date(startDate).getTime()) {
                let endTime = new Date(date_20_02_2010);
                let startTime = new Date(startDate);
                let days = 0,
                    month = 0,
                    years = 0;

                let daysPositive = endTime.getDate() + 1;
                let daysNegative = startTime.getDate() + Number(discountDaysBefore20);
                if (daysPositive < daysNegative) {
                    month--;
                    days = daysPositive + 30 - daysNegative;
                } else {
                    days = daysPositive - daysNegative;
                }
                if (days >= 30) {
                    month += (days / 30 >> 0);
                    days = days % 30;
                }
                let monthPositive = endTime.getMonth() + 1 + month;
                let monthNegative = startTime.getMonth() + 1;
                if (monthPositive < monthNegative) {
                    years--;
                    month = monthPositive + 12 - monthNegative;
                } else {
                    month = monthPositive - monthNegative;
                }
                if (month >= 12) {
                    month = month - 12;
                    years++;
                }
                years += endTime.getFullYear() - startTime.getFullYear();
                let age = {
                    years,
                    month,
                    days
                };
                console.log(age);
                let spentMoreThan_5_years = 0;
                let isMoreFive = false;
                if (years >= 5) {
                    spentMoreThan_5_years = years - 5;
                    isMoreFive = true;
                }
                let TotalFirst_5_years = 0;
                let TotalAfterFirst_5_years = 0;
                let calcYears = 0;
                if (isMoreFive) {
                    calcYears += 5 * 14;
                    calcYears += spentMoreThan_5_years * 21;
                    TotalFirst_5_years = 5 * 14;
                    TotalAfterFirst_5_years = spentMoreThan_5_years * 21;
                } else {
                    calcYears += years * 14;
                    TotalFirst_5_years = years * 14;
                }
                let calcMonth = spentMoreThan_5_years ? (month / 12) * 21 : (month / 12) * 14;
                let calcdays = spentMoreThan_5_years ? (days / 365) * 21 : (days / 365) * 14;
                let totalDays = calcdays + calcMonth + calcYears;
                let date = {
                    inYear: calcYears,
                    inMonth: calcMonth.toFixed(3),
                    inDays: calcdays.toFixed(3),
                    totalDays: totalDays.toFixed(3)
                };
                daysBefore20 = {
                    dateBefore20_2: age,
                    spentMoreThan_5_years,
                    before20_2: true,
                    date,
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysBefore20,
                        TotalFirst_5_years: TotalFirst_5_years.toFixed(3),
                        TotalAfterFirst_5_years: TotalAfterFirst_5_years.toFixed(3),
                        workDate: Object.assign({}, age)
                    }
                };
            }
            //  على القانون الجديد
            if (new Date(date_21_02_2010).getTime() < new Date(endDate).getTime()) {
                let endTime = new Date(endDate);
                let startTime = new Date(date_21_02_2010);
                let days = 0,
                    month = 0,
                    years = 0;

                let daysPositive = endTime.getDate() + 1;
                let daysNegative = startTime.getDate() + Number(discountDaysAfter20);
                if (daysPositive < daysNegative) {
                    month--;
                    days = daysPositive + 30 - daysNegative;
                } else {
                    days = daysPositive - daysNegative;
                }
                if (days >= 30) {
                    month += (days / 30 >> 0);
                    days = days % 30;
                }
                let monthPositive = endTime.getMonth() + 1 + month;
                let monthNegative = startTime.getMonth() + 1;
                if (monthPositive < monthNegative) {
                    years--;
                    month = monthPositive + 12 - monthNegative;
                } else {
                    month = monthPositive - monthNegative;
                }
                if (month >= 12) {
                    month = month - 12;
                    years++;
                }
                years += endTime.getFullYear() - startTime.getFullYear();
                let age = {
                    years,
                    month,
                    days
                };
                console.log(age);
                // عدد الايام طبقا للقانون الجديد
                let calcYears = years * additionVacation;
                let calcMonth = (month / 12) * additionVacation;
                let calcdays = (days / 365) * additionVacation;
                let totalDays = calcdays + calcMonth + calcYears;
                let date = {
                    inYear: calcYears,
                    inMonth: calcMonth.toFixed(3),
                    inDays: calcdays.toFixed(3),
                    totalDays: totalDays.toFixed(3)
                };
                // console.log(calcYears);
                daysAfter20 = {
                    dateAfter20_2: age,
                    after20_2: true,
                    date,
                    tableData: {
                        startWork: {
                            years: startTime.getFullYear(),
                            month: startTime.getMonth() + 1,
                            days: startTime.getDate()
                        },
                        endWork: {
                            years: endTime.getFullYear(),
                            month: endTime.getMonth() + 1,
                            days: endTime.getDate()
                        },
                        discountDaysAfter20,
                        additionVacation,
                        workDate: Object.assign({}, age)
                    }
                };
            }
            let totalVacationDays = Number(((_a = daysBefore20 === null || daysBefore20 === void 0 ? void 0 : daysBefore20.date) === null || _a === void 0 ? void 0 : _a.totalDays) || 0) + Number(((_b = daysAfter20 === null || daysAfter20 === void 0 ? void 0 : daysAfter20.date) === null || _b === void 0 ? void 0 : _b.totalDays) || 0);
            let onlyTotalVacationDaysWithOutPaidDays = totalVacationDays - vacationDaysPaid;
            let moneyForAnnualVacation = (salery / 26) * onlyTotalVacationDaysWithOutPaidDays;
            return {
                daysBefore20: {
                    title: `الايام قبل 20-2`,
                    val: daysBefore20
                },
                daysAfter20: {
                    title: `2-الايام بعد 20`,
                    val: daysAfter20
                },
                totalVacationDays: {
                    title: `اجمالي عدد الاجازات`,
                    val: totalVacationDays
                },
                onlyTotalVacationDaysWithOutPaidDays: {
                    title: `اجمالي عدد الاجازات بعد خصم الايام مدفوعه الاجر`,
                    val: onlyTotalVacationDaysWithOutPaidDays,
                    vacationDaysPaid
                },
                moneyForAnnualVacation: {
                    title: `مستحقات الاجازات السنوية`,
                    total: moneyForAnnualVacation.toFixed(3)
                },
                salery
            };
        };
        let calc_noticePeriod = (noticePeriodDays = 0, noticePeriodMonths = 0) => {
            let calcDays = (salery / 26) * noticePeriodDays;
            let calcMonths = salery * noticePeriodMonths;
            return {
                title: `اجمالى المستحق عن فترة الانزار`,
                total: (calcDays + calcMonths).toFixed(3),
                noticePeriodDays,
                noticePeriodMonths,
                calcDays: calcDays.toFixed(3),
                calcMonths
            };
        };
        let calc_delaySalery = (delaySaleryDays = 0, delaySaleryMonths = 0) => {
            let calcDays = (salery / 26) * delaySaleryDays;
            let calcMonths = salery * delaySaleryMonths;
            return {
                title: `اجمالى المستحق من الاجور المتاخرة`,
                total: (calcDays + calcMonths).toFixed(3),
                delaySaleryDays,
                delaySaleryMonths,
                calcDays: calcDays.toFixed(3),
                calcMonths
            };
        };
        let calc_weeklyRest = (weeklyRest = 0) => {
            let calcDays = (((salery / 26) * weeklyRest) / 100) * 150;
            return {
                title: `اجمالى المستحق عن بدل الراحة الاسبوعية`,
                total: (calcDays).toFixed(3),
                weeklyRest,
                calcDays: calcDays.toFixed(3),
            };
        };
        let calc_additionHours = (additionHours = 0, workHours) => {
            let hourRate = ((salery / 26) / workHours).toFixed(3);
            let calcHours = ((((salery / 26) / workHours) * additionHours) / 100) * 125;
            return {
                title: `اجمالى المستحق عن بدل ساعات العمل الاضافى`,
                total: (calcHours).toFixed(3),
                additionHours,
                workHours,
                hourRate,
                calcHours
            };
        };
        let calc_daysForVacation = (daysForVacation = 0) => {
            let calcDays = (salery / 26) * daysForVacation;
            return {
                title: `اجمالى المستحق عن بدل الاعياد`,
                total: (calcDays).toFixed(3),
                daysForVacation,
                calcDays: calcDays.toFixed(3),
            };
        };
        let calc_daysForVacation2 = (daysForVacation2 = 0) => {
            let calcDays = (((salery / 26) * daysForVacation2) / 100) * 200;
            return {
                title: `اجمالى المستحق عن بدل الاعياد التى تصادف راحة اسبوعية`,
                total: (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                daysForVacation2
            };
        };
        let calc_sickDays = (sickDays = 0) => {
            let ifMoreThan_100_days = sickDays > 15 ? 15 : sickDays;
            let ifMoreThan_75_days = Math.abs(ifMoreThan_100_days - sickDays) > 10 ? 10 : Math.abs(ifMoreThan_100_days - sickDays);
            let ifMoreThan_50_days = Math.abs((ifMoreThan_75_days + ifMoreThan_100_days) - sickDays) > 10 ? 10 : Math.abs((ifMoreThan_75_days + ifMoreThan_100_days) - sickDays);
            let ifMoreThan_25_days = Math.abs((ifMoreThan_50_days + ifMoreThan_75_days + ifMoreThan_100_days) - sickDays);
            let calcDays_100 = (((salery / 26) * ifMoreThan_100_days) / 100) * 100;
            let calcDays_75 = (((salery / 26) * ifMoreThan_75_days) / 100) * 75;
            let calcDays_50 = (((salery / 26) * ifMoreThan_50_days) / 100) * 50;
            let calcDays_25 = (((salery / 26) * ifMoreThan_25_days) / 100) * 25;
            return {
                "calcDays_100": {
                    title: `اجمالى المستحق عن الأيام المرضى باجر كامل`,
                    total: (calcDays_100).toFixed(3),
                    ifMoreThan_100_days
                },
                "calcDays_75": {
                    title: `اجمالى المستحق عن الأيام المرضى بثلاثة ارباع الاجر`,
                    total: (calcDays_75).toFixed(3),
                    ifMoreThan_75_days
                },
                "calcDays_50": {
                    title: `اجمالى المستحق عن الأيام المرضى بنصف الاجر`,
                    total: (calcDays_50).toFixed(3),
                    ifMoreThan_50_days
                },
                "calcDays_25": {
                    title: `اجمالى المستحق عن الأيام المرضى بربع الاجر`,
                    total: (calcDays_25).toFixed(3),
                    ifMoreThan_25_days
                },
                sickDays,
                total: (calcDays_25 + calcDays_50 + calcDays_75 + calcDays_100).toFixed(3)
            };
        };
        let calc_workInjury = (workInjuryDays = 0, workInjuryMonths = 0, treatmentFeesMonthes = 0, treatmentFeesDays = 0, treatmentFeesHalfMonthes = 0, treatmentFeesHalfDays = 0) => {
            let MoreThan_6_Month = workInjuryMonths >= 6 ? workInjuryMonths - 6 : false;
            let calcMonth = 0;
            let calcDays;
            let moneyForFullSalary = 0;
            let moneyForHalfSalary = 0;
            let calcFirstMonth_6 = 0;
            let calcLastMonth_6 = 0;
            let calcFirstDays_6 = 0;
            if (MoreThan_6_Month) {
                calcMonth += (((salery) * 6) / 100) * 100;
                moneyForFullSalary = calcMonth;
                calcFirstMonth_6 = calcMonth;
                calcMonth += (((salery) * MoreThan_6_Month) / 100) * 50;
                calcLastMonth_6 = (((salery) * MoreThan_6_Month) / 100) * 50;
                calcDays = (((salery / 26) * workInjuryDays) / 100) * 50;
                calcFirstDays_6 = calcDays;
                moneyForHalfSalary = Math.abs((calcMonth + calcDays) - moneyForFullSalary);
            } else {
                calcMonth += (((salery) * workInjuryMonths) / 100) * 100;
                calcFirstMonth_6 = calcMonth;
                calcDays = (((salery / 26) * workInjuryDays) / 100) * 100;
                calcFirstDays_6 = calcDays;
                moneyForFullSalary = calcMonth + calcDays;
            }

            let treatmentFeesFullMonthRes = salery * treatmentFeesMonthes;
            let treatmentFeesFullDaysRes = (salery / 26) * treatmentFeesDays;
            let treatmentFeesFullSalary = treatmentFeesFullMonthRes + treatmentFeesFullDaysRes

            let treatmentFeesHalfMonthRes = salery * treatmentFeesHalfMonthes / 2;
            let treatmentFeesHalfDaysRes = (salery / 26) * treatmentFeesHalfDays / 2;
            let treatmentFeesHalfSalary = treatmentFeesHalfMonthRes + treatmentFeesHalfDaysRes

            return {
                treatmentFeesFullSalary: {
                    title: `اجمالى اجور مدة العلاج بالاجر الكامل`,
                    total: (treatmentFeesFullSalary).toFixed(3),
                    treatmentFeesFullMonthRes,
                    treatmentFeesFullDaysRes,
                    treatmentFeesMonthes,
                    treatmentFeesDays
                },
                treatmentFeesHalfSalary: {
                    title: `اجمالى اجور مدة العلاج العمل بنصف الاجر`,
                    total: (treatmentFeesHalfSalary).toFixed(3),
                    treatmentFeesHalfMonthRes,
                    treatmentFeesHalfDaysRes,
                    treatmentFeesHalfMonthes,
                    treatmentFeesHalfDays
                },
                total: (calcDays + calcMonth).toFixed(3),
                MoreThan_6_Month,
                workInjuryDays,
                workInjuryMonths,
                calcDays: calcDays.toFixed(3),
                calcMonth,
                calcLastMonth_6,
                calcFirstMonth_6,
                calcFirstDays_6
            };
        };
        let calc_inCaseDead = (workInjuryDays = 0) => {
            let calcDays;
            let fixedVal;
            calcDays = (salery / 26) * workInjuryDays;
            fixedVal = (workInjuryDays == 0) ? 0 : 10000; // قيمه الديه الشرعيه
            return {
                title: `اجمالى المستحق عن إصابة العمل في حالة الوفاه`,
                total: fixedVal > calcDays ? fixedVal : (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                fixedVal,
                workInjuryDays
            };
        };
        let calc_inCaseTotalDisability = (TotalDisability = 0) => {
            let calcDays;
            let fixedVal;
            calcDays = (salery / 26) * TotalDisability;
            fixedVal = (TotalDisability == 0) ? 0 : 13333.33; // قيمه الديه الشرعيه
            return {
                title: `اجمالى المستحق عن العجز الدائم الكلى`,
                total: fixedVal > calcDays ? fixedVal : (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                fixedVal,
                TotalDisability
            };
        };
        let calc_inCasePartialDisability = (partialDisability = 0, precentDisability = 0) => {
            let calcDays;
            let fixedVal;
            calcDays = (((salery / 26) * partialDisability) / 100) * precentDisability;
            fixedVal = Math.round((13333.33 / 100) * precentDisability); // قيمه الديه الشرعيه
            return {
                title: `اجمالى المستحق عن العجز الجزئى`,
                total: fixedVal > calcDays ? fixedVal : (calcDays).toFixed(3),
                calcDays: calcDays.toFixed(3),
                fixedVal,
                partialDisability,
                precentDisability
            };
        };
        let calc_maternityLeave = (maternityLeaveDays = 0, maternityLeaveMonths = 0) => {
            let calcDays = (salery / 26) * maternityLeaveDays;
            let calcMonths = salery * maternityLeaveMonths;
            return {
                title: `اجمالى المستحق إجازة الوضع`,
                total: (calcDays + calcMonths).toFixed(3),
                calcDays: calcDays.toFixed(3),
                calcMonths,
                maternityLeaveDays,
                maternityLeaveMonths
            };
        };
        let calc_maternityLeave2 = (maternityLeaveDays2 = 0, maternityLeaveMonths2 = 0) => {
            let calcDays = (salery / 26) * maternityLeaveDays2;
            let calcMonths = salery * maternityLeaveMonths2;
            return {
                title: `اجمالى المستحق إجازة عدة`,
                total: (calcDays + calcMonths).toFixed(3),
                calcDays: calcDays.toFixed(3),
                calcMonths,
                maternityLeaveDays2,
                maternityLeaveMonths2
            };
        };
        // // // // //
        let endDateAwardRes = endDateAward(startWork, endWork, discountDaysFromEnd, salery, saleryPlus, endReason, discountInsurance);
        let calcLawDateRes = calcLawDate(startWork, endWork, discountDaysBefore20, discountDaysAfter20, vacationDaysPaid, salery, additionVacation);
        let calc_noticePeriodRes = calc_noticePeriod(noticePeriodDays, noticePeriodMonths);
        let calc_delaySaleryRes = calc_delaySalery(delaySaleryDays, delaySaleryMonths);
        let calc_weeklyRestRes = calc_weeklyRest(weeklyRest);
        let calc_additionHoursRes = calc_additionHours(additionHours, workHours);
        let calc_daysForVacationRes = calc_daysForVacation(daysForVacation);
        let calc_daysForVacation2Res = calc_daysForVacation2(daysForVacation2);
        let calc_sickDaysRes = calc_sickDays(sickDays);
        let calc_workInjuryRes = calc_workInjury(workInjuryDays, workInjuryMonths, treatmentFeesMonthes, treatmentFeesDays, treatmentFeesHalfMonthes, treatmentFeesHalfDays);
        let calc_inCaseDeadRes = calc_inCaseDead(workInjuryDays);
        let calc_inCaseTotalDisabilityRes = calc_inCaseTotalDisability(TotalDisability);
        let calc_inCasePartialDisabilityRes = calc_inCasePartialDisability(partialDisability, precentDisability);
        let calc_maternityLeaveRes = calc_maternityLeave(maternityLeaveDays, maternityLeaveMonths);
        let calc_maternityLeaveRes2 = calc_maternityLeave2(maternityLeaveDays2, maternityLeaveMonths2);
        let allResult = {
            endDateAwardRes,
            calcLawDateRes,
            calc_noticePeriodRes,
            calc_delaySaleryRes,
            calc_weeklyRestRes,
            calc_additionHoursRes,
            calc_daysForVacationRes,
            calc_daysForVacation2Res,
            calc_sickDaysRes,
            calc_workInjuryRes,
            calc_inCaseDeadRes,
            calc_inCaseTotalDisabilityRes,
            calc_inCasePartialDisabilityRes,
            calc_maternityLeaveRes,
            calc_maternityLeaveRes2,
            salery,
            saleryPlus
        };
        let listOfResult = [
            calc_noticePeriodRes,
            calc_delaySaleryRes,
            calc_weeklyRestRes,
            calc_additionHoursRes,
            calc_daysForVacationRes,
            calc_daysForVacation2Res,
            calc_sickDaysRes.calcDays_100,
            calc_sickDaysRes.calcDays_75,
            calc_sickDaysRes.calcDays_50,
            calc_sickDaysRes.calcDays_25,
            calc_workInjuryRes.treatmentFeesFullSalary,
            calc_workInjuryRes.treatmentFeesHalfSalary,
            calc_inCaseDeadRes,
            calc_inCaseTotalDisabilityRes,
            calc_inCasePartialDisabilityRes,
            calc_maternityLeaveRes,
            calc_maternityLeaveRes2,
            calcLawDateRes.moneyForAnnualVacation
        ];
        return {
            allResult,
            listOfResult
        }
    }

    $("#calc-worker").submit(function(e) {
        e.preventDefault();
        var obj = {};
        $(".calc").each(function() {
            let name = $(this).attr("name");
            obj[name] = $(this).val();
        });
        let result = calc(obj);
        console.log(result);
        $('html, body').animate({
            scrollTop: 0
        }, 1000);

        // endDateAwardRes ============= start ====================
        let endDateAwardRes = result.allResult.endDateAwardRes;
        $(".endDateAwardRes .end-d").html(endDateAwardRes.tableData.endWork.days);
        $(".endDateAwardRes .end-m").html(endDateAwardRes.tableData.endWork.month);
        $(".endDateAwardRes .end-y").html(endDateAwardRes.tableData.endWork.years);
        $(".endDateAwardRes .start-d").html(endDateAwardRes.tableData.startWork.days);
        $(".endDateAwardRes .start-m").html(endDateAwardRes.tableData.startWork.month);
        $(".endDateAwardRes .start-y").html(endDateAwardRes.tableData.startWork.years);
        $(".endDateAwardRes .work-d").html(endDateAwardRes.tableData.workDate.days);
        $(".endDateAwardRes .work-m").html(endDateAwardRes.tableData.workDate.month);
        console.log('d==10', endDateAwardRes.tableData.discountDaysFromEnd);
        $(".endDateAwardRes .discount-d").html(endDateAwardRes.tableData.discountDaysFromEnd);
        $(".endDateAwardRes .finalAward").html(endDateAwardRes.finalAwardAmount.title + " : " + endDateAwardRes.totalAmount.total);
        $(".endDateAwardRes .reason").html(endDateAwardRes.reason);
        $(".endDateAwardRes .finalAmount").html(endDateAwardRes.finalAmount.title + " : " + endDateAwardRes.finalAmount.total);
        $(".endDateAwardRes .work-date-y").html(endDateAwardRes.tableData.workDate.years);

        let endCalcHtml = ``;
        let work_salary = Number(result.allResult.salery) + Number(result.allResult.saleryPlus);
        if (endDateAwardRes.isMoreFive) {
            endCalcHtml = `<tr>
                                <td class="red-print">عن السنوات</td>
                                <td>` + endDateAwardRes.tableData.spentMoreThan_5_years + `</td>
                                <td></td>
                                <td>x</td>
                                <td></td>
                                <td>` + work_salary + `</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.last_5_years + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">عن السنوات</td>
                                <td>5</td>
                                <td>x</td>
                                <td><span>` + work_salary + `</span> <hr> 26</td>
                                <td>x</td>
                                <td>15</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.first_5_years + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الاشهر</td>
                                <td><span>` + endDateAwardRes.tableData.workDate.month + `</span> <hr> 12</td>
                                <td></td>
                                <td>x</td>
                                <td></td>
                                <td>` + work_salary + `</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.calcMonthAmount + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الايام</td>
                                <td><span>` + endDateAwardRes.tableData.workDate.days + `</span> <hr> 365</td>
                                <td></td>
                                <td>x</td>
                                <td></td>
                                <td>` + work_salary + `</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.calcdaysAmount + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">الاجمالى</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>` + endDateAwardRes.totalAmount.total + `</td>
                            </tr>`;
        } else {
            endCalcHtml = `<tr>
                                <td class="red-print">عن السنوات</td>
                                <td>` + endDateAwardRes.tableData.workDate.years + `</td>
                                <td>x</td>
                                <td><span>` + work_salary + `</span> <hr> 26</td>
                                <td>x</td>
                                <td>15</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.first_5_years + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الاشهر</td>
                                <td><span>` + endDateAwardRes.tableData.workDate.month + `</span> <hr> 12</td>
                                <td>x</td>
                                <td><span>` + work_salary + `</span> <hr> 26</td>
                                <td>x</td>
                                <td>15</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.calcMonthAmount + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">عن الايام</td>
                                <td><span>` + endDateAwardRes.tableData.workDate.days + `</span> <hr> 365</td>
                                <td>x</td>
                                <td><span>` + work_salary + `</span> <hr> 26</td>
                                <td>x</td>
                                <td>15</td>
                                <td>=</td>
                                <td>` + endDateAwardRes.tableData.calcdaysAmount + `</td>
                            </tr>
                            <tr>
                                <td class="red-print">الاجمالى</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>` + endDateAwardRes.totalAmount.total + `</td>
                            </tr>`;
        }
        $('#endDateAwardRes-calc').html(endCalcHtml);
        // endDateAwardRes ============= end ======================

        // calcLawDateRes ============= start =====================
        let calcLawDateRes = result.allResult.calcLawDateRes;
        $(".page3 .after-discount-d").html(calcLawDateRes.daysAfter20.val.tableData.discountDaysAfter20);
        let calcLawDateDays;

        if (calcLawDateRes.daysBefore20.val) {
            $(".page3 .before-discount-d").html(calcLawDateRes.daysBefore20.val.tableData.discountDaysBefore20);
            calcLawDateDays = calcLawDateRes.daysBefore20.val;
            $(".calcLawDateRes-before .end-d").html(calcLawDateDays.tableData.endWork.days);
            $(".calcLawDateRes-before .end-m").html(calcLawDateDays.tableData.endWork.month);
            $(".calcLawDateRes-before .end-y").html(calcLawDateDays.tableData.endWork.years);
            $(".calcLawDateRes-before .start-d").html(calcLawDateDays.tableData.startWork.days);
            $(".calcLawDateRes-before .start-m").html(calcLawDateDays.tableData.startWork.month);
            $(".calcLawDateRes-before .start-y").html(calcLawDateDays.tableData.startWork.years);
            $(".calcLawDateRes-before .work-d").html(calcLawDateDays.tableData.workDate.days);
            $(".calcLawDateRes-before .work-m").html(calcLawDateDays.tableData.workDate.month);
            $(".calcLawDateRes-before .work-y").html(calcLawDateDays.tableData.workDate.years);
            $(".calcLawDateRes-before .in-d").html(calcLawDateDays.date.inDays);
            $(".calcLawDateRes-before .in-m").html(calcLawDateDays.date.inMonth);
            $(".calcLawDateRes-before .in-y").html(calcLawDateDays.date.inYear);
            $(".calcLawDateRes-before .in-t").html(calcLawDateDays.date.totalDays);
            $(".calcLawDateRes-before").show();
        } else {
            $(".calcLawDateRes-before").hide();
        }

        if (calcLawDateRes.daysAfter20.val) {
            calcLawDateDays = calcLawDateRes.daysAfter20.val;
            $(".calcLawDateRes-after .end-d").html(calcLawDateDays.tableData.endWork.days);
            $(".calcLawDateRes-after .end-m").html(calcLawDateDays.tableData.endWork.month);
            $(".calcLawDateRes-after .end-y").html(calcLawDateDays.tableData.endWork.years);
            $(".calcLawDateRes-after .start-d").html(calcLawDateDays.tableData.startWork.days);
            $(".calcLawDateRes-after .start-m").html(calcLawDateDays.tableData.startWork.month);
            $(".calcLawDateRes-after .start-y").html(calcLawDateDays.tableData.startWork.years);
            $(".calcLawDateRes-after .work-d").html(calcLawDateDays.tableData.workDate.days);
            $(".calcLawDateRes-after .work-m").html(calcLawDateDays.tableData.workDate.month);
            $(".calcLawDateRes-after .work-y").html(calcLawDateDays.tableData.workDate.years);
            $(".calcLawDateRes-after .in-d").html(calcLawDateDays.date.inDays);
            $(".calcLawDateRes-after .in-m").html(calcLawDateDays.date.inMonth);
            $(".calcLawDateRes-after .in-y").html(calcLawDateDays.date.inYear);
            $(".calcLawDateRes-after .in-t").html(calcLawDateDays.date.totalDays);
            $(".calcLawDateRes-after").show();
        } else {
            $(".calcLawDateRes-after").hide();
        }

        $(".calcLawDateRes .totalVacationDays .title").html(calcLawDateRes.totalVacationDays.title);
        $(".calcLawDateRes .totalVacationDays .total").html(calcLawDateRes.totalVacationDays.val.toFixed(3));
        $(".calcLawDateRes .onlyTotalVacationDaysWithOutPaidDays .title").html(calcLawDateRes.onlyTotalVacationDaysWithOutPaidDays.title);
        $(".calcLawDateRes .onlyTotalVacationDaysWithOutPaidDays .total").html(calcLawDateRes.onlyTotalVacationDaysWithOutPaidDays.vacationDaysPaid);
        $(".calcLawDateRes .moneyForAnnualVacation .title").html(calcLawDateRes.moneyForAnnualVacation.title);
        $(".calcLawDateRes .moneyForAnnualVacation .total").html(calcLawDateRes.moneyForAnnualVacation.total);
        $(".calcLawDateRes .onlyTotalVacationDaysWithOutPaidDays .valt").html(calcLawDateRes.onlyTotalVacationDaysWithOutPaidDays.val.toFixed(3));
        $(".calcLawDateRes .work-s").html(Number(result.allResult.salery));
        // calcLawDateRes ============= end =======================

        // receivables table ============= start ===================
        var tableHtml = "";
        var totalNumber = 0;

        tableHtml += `<tr>
                        <td class="red-print">مستحقات مكافاة نهاية الخدمة</td>
                        <td>` + endDateAwardRes.finalAmount.total + `</td>
                    </tr>`;
        totalNumber += Number(endDateAwardRes.finalAmount.total);

        for (let i = 0; i < result.listOfResult.length; i++) {
            let element = result.listOfResult[i];
            if (element.total != 0) {
                tableHtml += `<tr>
                        <td class="red-print">` + element.title + `</td>
                        <td>` + element.total + `</td>
                    </tr>`;
                totalNumber += Number(element.total);
            }
        }
        tableHtml += `<tr>
                        <td class="red-print gawa">اجمالى قيمة المستحقات</td>
                        <td class="gawa">` + totalNumber.toFixed(3) + `</td>
                    </tr>`;

        $(".receivables").html(tableHtml);
        $(".form-work").hide();
        $("#bee").show();
        $(".form-result").show();
        $(".area-print").show();
        // receivables table ============= end ======================

        // userInfo table ============= start ===================
        $(".userInfo .user-name").html($(".user-info-name").val());
        $(".userInfo .user-salary").html(result.allResult.salery);
        $(".userInfo .user-company").html($(".user-info-company").val());
        $(".userInfo .user-salary-plus").html(result.allResult.saleryPlus);
        $(".userInfo .user-job").html($(".user-info-job").val());
        $(".userInfo .user-hours").html($(".user-info-hours").val());
        $(".userInfo .additionVacation").html($(".user-info-additionVacation").val());

        let todayTime = new Date($(".user-info-startWork").val());
        let month = todayTime.getMonth() + 1;
        let day = todayTime.getDate();
        let year = todayTime.getFullYear();
        let start_format = day + "/" + month + "/" + year;
        $(".userInfo .startWork").html(start_format);

        todayTime = new Date($(".user-info-endWork").val());
        month = todayTime.getMonth() + 1;
        day = todayTime.getDate();
        year = todayTime.getFullYear();
        let end_format = day + "/" + month + "/" + year;
        $(".userInfo .endWork").html(end_format);


        let hidden = 0
        if ($(".user-info-discountDaysFromEnd").val()) {
            $(".userInfo .discountDaysFromEnd").html($(".user-info-discountDaysFromEnd").val());
            $(".userInfo .discountDaysFromEnd").parent().show();
            hidden = 1;
        }
        if ($(".user-info-discountDaysBefore20").val()) {
            $(".userInfo .discountDaysBefore20").html($(".user-info-discountDaysBefore20").val());
            $(".userInfo .discountDaysBefore20").parent().show();
            hidden = 1;
        }
        if ($(".user-info-discountDaysAfter20").val()) {
            $(".userInfo .discountDaysAfter20").html($(".user-info-discountDaysAfter20").val());
            $(".userInfo .discountDaysAfter20").parent().show();
            hidden = 1;
        }
        if ($(".user-info-vacationDaysPaid").val()) {
            $(".userInfo .vacationDaysPaid").html($(".user-info-vacationDaysPaid").val());
            $(".userInfo .vacationDaysPaid").parent().show();
            hidden = 1;
        }

        if (hidden == 0) {
            $('.dmy').hide();
        } else {
            $('.dmy').show();
        }
        // userInfo table ============= end ======================

        // page4 table ============= start ===================
        if (result.allResult.calc_noticePeriodRes.total == 0) {
            $(".noticePeriodDays").hide();
        } else {
            $(".noticePeriodDays").show();
            $(".noticePeriodDays .work-s").html(result.allResult.salery);
            $(".noticePeriodDays .notice-days").html(result.allResult.calc_noticePeriodRes.noticePeriodDays);
            $(".noticePeriodDays .notice-days-res").html(result.allResult.calc_noticePeriodRes.calcDays);
            $(".noticePeriodDays .notice-month").html(result.allResult.calc_noticePeriodRes.noticePeriodMonths);
            $(".noticePeriodDays .notice-month-res").html(result.allResult.calc_noticePeriodRes.calcMonths);
            $(".noticePeriodDays .notice-res").html(result.allResult.calc_noticePeriodRes.total);
        }

        if (result.allResult.calc_delaySaleryRes.total == 0) {
            $(".delaySaleryDays").hide();
        } else {
            $(".delaySaleryDays").show();
            $(".delaySaleryDays .work-s").html(result.allResult.salery);
            $(".delaySaleryDays .delay-days").html(result.allResult.calc_delaySaleryRes.delaySaleryDays);
            $(".delaySaleryDays .delay-days-res").html(result.allResult.calc_delaySaleryRes.calcDays);
            $(".delaySaleryDays .delay-month").html(result.allResult.calc_delaySaleryRes.delaySaleryMonths);
            $(".delaySaleryDays .delay-month-res").html(result.allResult.calc_delaySaleryRes.calcMonths);
            $(".delaySaleryDays .delay-res").html(result.allResult.calc_delaySaleryRes.total);
        }

        if (result.allResult.calc_weeklyRestRes.total == 0) {
            $(".weeklyRestRes").hide();
        } else {
            $(".weeklyRestRes").show();
            $(".weeklyRestRes .work-s").html(result.allResult.salery);
            $(".weeklyRestRes .weeklyRest-days").html(result.allResult.calc_weeklyRestRes.weeklyRest);
            $(".weeklyRestRes .weeklyRest-res").html(result.allResult.calc_weeklyRestRes.total);
        }

        if (result.allResult.calc_additionHoursRes.total == 0) {
            $(".additionHoursRes").hide();
        } else {
            $(".additionHoursRes").show();
            $(".additionHoursRes .work-s").html(result.allResult.salery);
            $(".additionHoursRes .add-hours").html(result.allResult.calc_additionHoursRes.additionHours);
            $(".additionHoursRes .hour-rate").html(result.allResult.calc_additionHoursRes.hourRate);
            $(".additionHoursRes .work-hours").html(result.allResult.calc_additionHoursRes.workHours);
            $(".additionHoursRes .addHour-res").html(result.allResult.calc_additionHoursRes.total);
        }

        if (result.allResult.calc_daysForVacationRes.total == 0) {
            $(".daysForVacation").hide();
        } else {
            $(".daysForVacation").show();
            $(".daysForVacation .work-s").html(result.allResult.salery);
            $(".daysForVacation .daysvac-days").html(result.allResult.calc_daysForVacationRes.daysForVacation);
            $(".daysForVacation .daysvac-res").html(result.allResult.calc_daysForVacationRes.total);
        }

        if (result.allResult.calc_daysForVacation2Res.total == 0) {
            $(".daysForVacation2").hide();
        } else {
            $(".daysForVacation2").show();
            $(".daysForVacation2 .work-s").html(result.allResult.salery);
            $(".daysForVacation2 .daysvac2-days").html(result.allResult.calc_daysForVacation2Res.daysForVacation2);
            $(".daysForVacation2 .daysvac2-res").html(result.allResult.calc_daysForVacation2Res.total);
        }

        if (result.allResult.calc_sickDaysRes.total == 0) {
            $(".sickdays").hide();
        } else {
            $(".sickdays").show();
            if (result.allResult.calc_sickDaysRes.calcDays_25.total == 0) {
                $(".sick25").hide();
            } else {
                $(".sick25").show();
                $(".sick25 .work-s").html(result.allResult.salery);
                $(".sick25 .sick25-days").html(result.allResult.calc_sickDaysRes.calcDays_25.ifMoreThan_25_days);
                $(".sick25 .sick25-res").html(result.allResult.calc_sickDaysRes.calcDays_25.total);
            }
            if (result.allResult.calc_sickDaysRes.calcDays_50.total == 0) {
                $(".sick50").hide();
            } else {
                $(".sick50").show();
                $(".sick50 .work-s").html(result.allResult.salery);
                $(".sick50 .sick50-days").html(result.allResult.calc_sickDaysRes.calcDays_50.ifMoreThan_50_days);
                $(".sick50 .sick50-res").html(result.allResult.calc_sickDaysRes.calcDays_50.total);
            }
            if (result.allResult.calc_sickDaysRes.calcDays_75.total == 0) {
                $(".sick75").hide();
            } else {
                $(".sick75").show();
                $(".sick75 .work-s").html(result.allResult.salery);
                $(".sick75 .sick75-days").html(result.allResult.calc_sickDaysRes.calcDays_75.ifMoreThan_75_days);
                $(".sick75 .sick75-res").html(result.allResult.calc_sickDaysRes.calcDays_75.total);
            }
            if (result.allResult.calc_sickDaysRes.calcDays_100.total == 0) {
                $(".sick100").hide();
            } else {
                $(".sick100").show();
                $(".sick100 .work-s").html(result.allResult.salery);
                $(".sick100 .sick100-days").html(result.allResult.calc_sickDaysRes.calcDays_100.ifMoreThan_100_days);
                $(".sick100 .sick100-res").html(result.allResult.calc_sickDaysRes.calcDays_100.total);
            }
        }

        if (result.allResult.calc_workInjuryRes.treatmentFeesFullSalary.total == 0) {
            $(".treatmentFeesFull").hide();
        } else {
            $(".treatmentFeesFull").show();
            $(".treatmentFeesFull .work-s").html(result.allResult.salery);
            $(".treatmentFeesFull .full-days").html(result.allResult.calc_workInjuryRes.treatmentFeesFullSalary.treatmentFeesDays);
            $(".treatmentFeesFull .full-days-res").html(result.allResult.calc_workInjuryRes.treatmentFeesFullSalary.treatmentFeesFullDaysRes);
            $(".treatmentFeesFull .full-month").html(result.allResult.calc_workInjuryRes.treatmentFeesFullSalary.treatmentFeesMonthes);
            $(".treatmentFeesFull .full-month-res").html(result.allResult.calc_workInjuryRes.treatmentFeesFullSalary.treatmentFeesFullMonthRes);
            $(".treatmentFeesFull .full-res").html(result.allResult.calc_workInjuryRes.treatmentFeesFullSalary.total);
        }
        if (result.allResult.calc_workInjuryRes.treatmentFeesHalfSalary.total == 0) {
            $(".treatmentFeesHalf").hide();
        } else {
            $(".treatmentFeesHalf").show();
            $(".treatmentFeesHalf .work-s").html(result.allResult.salery);
            $(".treatmentFeesHalf .half-days").html(result.allResult.calc_workInjuryRes.treatmentFeesHalfSalary.treatmentFeesHalfDays);
            $(".treatmentFeesHalf .half-days-res").html(result.allResult.calc_workInjuryRes.treatmentFeesHalfSalary.treatmentFeesHalfDaysRes);
            $(".treatmentFeesHalf .half-month").html(result.allResult.calc_workInjuryRes.treatmentFeesHalfSalary.treatmentFeesHalfMonthes);
            $(".treatmentFeesHalf .half-month-res").html(result.allResult.calc_workInjuryRes.treatmentFeesHalfSalary.treatmentFeesHalfMonthRes);
            $(".treatmentFeesHalf .half-res").html(result.allResult.calc_workInjuryRes.treatmentFeesHalfSalary.total);
        }

        if (result.allResult.calc_inCaseDeadRes.total == 0) {
            $(".inCaseDead").hide();
        } else {
            $(".inCaseDead").show();
            $(".inCaseDead .work-s").html(result.allResult.salery);
            $(".inCaseDead .dead-days").html(result.allResult.calc_inCaseDeadRes.workInjuryDays);
            $(".inCaseDead .dead-days-res").html(result.allResult.calc_inCaseDeadRes.calcDays);
            $(".inCaseDead .dead-res").html(result.allResult.calc_inCaseDeadRes.total);
        }

        if (result.allResult.calc_inCaseTotalDisabilityRes.total == 0) {
            $(".totalDisability").hide();
        } else {
            $(".totalDisability").show();
            $(".totalDisability .work-s").html(result.allResult.salery);
            $(".totalDisability .totalDisable-days").html(result.allResult.calc_inCaseTotalDisabilityRes.TotalDisability);
            $(".totalDisability .totalDisable-days-res").html(result.allResult.calc_inCaseTotalDisabilityRes.calcDays);
            $(".totalDisability .totalDisable-res").html(result.allResult.calc_inCaseTotalDisabilityRes.total);
        }

        if (result.allResult.calc_inCasePartialDisabilityRes.total == 0) {
            $(".partDisability").hide();
        } else {
            $(".partDisability").show();
            $(".partDisability .work-s").html(result.allResult.salery);
            $(".partDisability .partDisable-days").html(result.allResult.calc_inCasePartialDisabilityRes.partialDisability);
            $(".partDisability .partDisable-days-res").html(result.allResult.calc_inCasePartialDisabilityRes.calcDays);
            $(".partDisability .partDisable-res").html(result.allResult.calc_inCasePartialDisabilityRes.total);
            $(".partDisability .partDisable-val").html(result.allResult.calc_inCasePartialDisabilityRes.fixedVal);
            $(".partDisability .partDisable-percent").html(result.allResult.calc_inCasePartialDisabilityRes.precentDisability);
        }

        if (result.allResult.calc_maternityLeaveRes.total == 0) {
            $(".maternity").hide();
        } else {
            $(".maternity").show();
            $(".maternity .work-s").html(result.allResult.salery);
            $(".maternity .maternity-days").html(result.allResult.calc_maternityLeaveRes.maternityLeaveDays);
            $(".maternity .maternity-days-res").html(result.allResult.calc_maternityLeaveRes.calcDays);
            $(".maternity .maternity-month").html(result.allResult.calc_maternityLeaveRes.maternityLeaveMonths);
            $(".maternity .maternity-month-res").html(result.allResult.calc_maternityLeaveRes.calcMonths);
            $(".maternity .maternity-res").html(result.allResult.calc_maternityLeaveRes.total);
        }

        if (result.allResult.calc_maternityLeaveRes2.total == 0) {
            $(".maternity2").hide();
        } else {
            $(".maternity2").show();
            $(".maternity2 .work-s").html(result.allResult.salery);
            $(".maternity2 .maternity-days").html(result.allResult.calc_maternityLeaveRes2.maternityLeaveDays2);
            $(".maternity2 .maternity-days-res").html(result.allResult.calc_maternityLeaveRes2.calcDays);
            $(".maternity2 .maternity-month").html(result.allResult.calc_maternityLeaveRes2.maternityLeaveMonths2);
            $(".maternity2 .maternity-month-res").html(result.allResult.calc_maternityLeaveRes2.calcMonths);
            $(".maternity2 .maternity-res").html(result.allResult.calc_maternityLeaveRes2.total);
        }

        // page4 table ============= end ======================

        return false;
    });

    $("#calc-print").click(function(e) {
        $("#header").hide();
        $(".custom-page-header").hide();
        $(".benfits-nonprint").hide();
        $("#footer").hide();
        $("body").addClass("body-print");
        window.print();
    });

    $("#back-form").click(function(e) {
        $(".form-work").show();
        $(".form-result").hide();
        $("#bee").hide();
        $(".area-print").hide();
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    $("#bee").click(function(e) {
        html2canvas(document.querySelector("#t4")).then(canvas => {
            canvas.toBlob(blob => navigator.clipboard.write([new ClipboardItem({ 'image/png': blob })]));
            var image = new Image();
            image.src = canvas.toDataURL();
            image.height = document.querySelector("#t4").clientHeight;
            image.width = document.querySelector("#t4").clientWidth;
            $("#v4").html(image);
        });
    });

    $(".form-result table").click(function() {
        let tid = $(this).attr('id');
        console.log(tid);
        if (tid != 't4') {
            $("#v4").html("");
            $(this).clone().appendTo("#v4");
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
            $("#cli").show();
        }
    });

    $("#cli").click(function(e) {
        $("#cli").val("جارى التحويل");
        html2canvas(document.querySelector("#v4")).then(canvas => {
            // canvas.toBlob(blob => navigator.clipboard.write([new ClipboardItem({ 'image/png': blob })]));
            $("#v4").html(canvas);
            console.log("is copied")
            $("#cli").val("تم التحويل");
            $("#cli").fadeOut(1500, function() {
                $("#cli").val("تحويل الجدول الى صورة");
            });
        });
    });

}).apply(this, [jQuery]);