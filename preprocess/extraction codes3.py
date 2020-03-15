######################################## json 파일에서 형태소 추출코드 ############################################
# import json
# import os
# import sys

# os.chdir(os.getcwd())

# file = os.listdir(os.getcwd())

# for filename in file :

#    if 'json' in filename :

#        sys.stdout = open(filename[:-5] + ".txt", "w", -1, "utf-8")
#        with open(filename, 'rt',-1, "utf-8") as json_file:
#            json_data = json.load(json_file)

#        for j in range(0,len(json_data["sentence"])):
#            #for i in range(0,len(json_data["sentence"][j]["morp"])):
#            for i in range(0,len(json_data["sentence"][j]["dependency"])):
#                #json_lemma = json_data["sentence"][j]["morp"][i]["lemma"]
#                json_lemma = json_data["sentence"][j]["dependency"][i]["text"]
#                #json_type = json_data["sentence"][j]["morp"][i]["type"]
#                json_type = json_data["sentence"][j]["dependency"][i]["label"]
#                print(json_lemma + "\t" + json_type)
#            print("\n")
###############################################################################################################

####################################### 개체명 추출 코드 ###########################################
# import os
# import sys
# import mecab
#
# os.chdir(os.getcwd())
# mecab = mecab.MeCab()
#
# sys.stdout = open("NEW_NEtaggedCorpus_train.txt", "w", -1, "utf-8")
# f = open("NEtaggedCorpus_train.txt", "rt", -1, "utf-8")
#
# while True:
#     line = f.readline()
#     if not line:
#         break
#
#     tokened_str = mecab.morphs(line)
#
#     check = 0
#     lemma = []
#     type = []
#
#     for i in range(0,len(tokened_str)):
#
#        if '<' in tokened_str[i] :
#            check = 1
#        elif check == 0:
#            print(tokened_str[i] + " O")
#        elif check==1:
#                lemma.append(tokened_str[i])
#                if (i + 1) <= len(tokened_str):
#                    if ':' in tokened_str[i+1]:
#                         check=2
#        elif check==2:
#            check = 3
#        elif check==3:
#            type.append(tokened_str[i])
#            if (i + 1) <= len(tokened_str):
#                if '>' in tokened_str[i+1]:
#                     check=4
#                     print("".join(lemma) + " " + "".join(type))
#                     lemma = []
#                     type = []
#        elif check==4:
#            check = 0
#
#     print("\n")

###############################################################################################################

####################################### 국립국어원 데이터 개체명 부착 코드 ############################################
# import json
# import os
# import sys
#
# os.chdir(os.getcwd())
#
# file = os.listdir(os.getcwd())
#
# for filename in file :
#
#    if 'json' in filename :
#
#        sys.stdout = open(filename[:-5] + ".txt", "w", -1, "utf-8")
#        with open(filename, 'rt', -1, "utf-8") as json_file:
#            json_data = json.load(json_file)
#
#        for j in range(0 ,len(json_data["sentence"])):
#            text = json_data["sentence"][j]["text"]
#            json_text = []
#            json_type = []
#            for i in range(0,len(json_data["sentence"][j]["NE"])):
#                json_text.append(json_data["sentence"][j]["NE"][i]["text"])
#                json_type.append(json_data["sentence"][j]["NE"][i]["type"])
#
#            json_text_copy = []
#            for k in range(0 ,len(json_text)):
#                if json_text[k] in json_text_copy:
#                    continue
#                else :
#                    text = text.replace(json_text[k] ,("<" + json_text[k] + ":" + json_type[k] + ">"))
#                    json_text_copy.append(json_text[k])
#
#            print(text)

##############################################################################################################

# ####################################### 네이버 nlp 데이터 처리 코 ###########################################
# import os
# import sys
#
# os.chdir(os.getcwd())
#
# sys.stdout = open("NEW_train_data.txt", "w", -1, "utf-8")
# f = open("train_data.txt", "rt", -1, "utf-8")
#
# textbox = ""
#
# while True:
#     line = f.readline()
#     if not line:
#         break
#     elif line == "\n" :
#         print(textbox + "\n")
#         textbox=""
#         continue
#
#     new_line = line[2:]
#     text = ""
#     type = ""
#     new_line_index = 0
#
#     if new_line[0] == "\t" : new_line = new_line[1:]
#
#     for i in range(0,len(new_line)):
#         new_line_index += 1
#         if "\t" == new_line[i]: break
#         else :
#             text = text + new_line[i]
#
#     for j in range(new_line_index,len(new_line)):
#         type = type + new_line[j]
#
#     if "PER" in type : type = "".join(type).replace("PER","PS");
#     elif "ORG" in type : type = "".join(type).replace("ORG","OG")
#     elif "DAT" in type : type = "".join(type).replace("DAT","DT")
#     elif "TIM" in type : type = "".join(type).replace("TIM","TI")
#     elif "LOC" in type : type = "".join(type).replace("LOC","LC")
#     else : type = "O" + "\n"
#
#     textbox = textbox + text + " " + type

###############################################################################################################

###################################### pytorch-bert-crf-ner 데이터  ############################################
import os
import sys

os.chdir(os.getcwd())

file = os.listdir(os.getcwd())

sys.stdout = open("NER_github.txt", "w", -1, "utf-8")

count=0
for filename in file :
    count +=1
    if 'txt' in filename :
        f = open(filename, "rt", -1, "utf-8")

        while True:
            line = f.readline()
            if not line:
                break
            elif (line[0] == "#") :
                print("")
                continue
            elif(line[0] == "\n") | (line[0] == "_") :
                continue
            elif "NER_github" in filename :
                continue

            box = line.split("\t")
            text = box[0];
            type = box[3][:-1];

            if "I-PER" in type : type = "PS_I"
            elif "B-PER" in type : type = "PS_B"
            elif "I-ORG" in type : type = "OG_I"
            elif "B-ORG" in type : type = "OG_B"
            elif "B-LOC" in type : type = "LC_B"
            elif "I-LOC" in type : type = "LC_I"
            elif "B-DAT" in type : type = "DT_B"
            elif "B-DAT" in type : type = "DT_B"
            elif "I-TIM" in type : type = "TI_I"
            elif "B-TIM" in type : type = "TI_B"
            else : type = "O"

            print(text + " " + type)

    print("\n")

#############################################################################################################
